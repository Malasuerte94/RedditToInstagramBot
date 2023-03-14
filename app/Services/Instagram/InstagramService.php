<?php

namespace App\Services\Instagram;

use App\Models\Log;
use App\Models\Post;
use App\Services\LogService;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class InstagramService
{
    public $client;
    public $secret;

    public function __construct()
    {
        $this->client = config('instagram.instagram_id');
        $this->secret = config('instagram.instagram_secret');
    }

    /**
     * Connecting to the server and retrieving the instagram page id
     * @return array
     */
    public function getAccountId(): array
    {
        $user = auth()->user();
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/v15.0/me/accounts', [
            'query' => [
                'access_token' => $user->token,
            ],
        ]);
        $json_response = json_decode($response->getBody(), true);
        foreach ($json_response['data'] as $account) {
            if (isset($account['id'])) {
                return [
                    'id' => $account['id'],
                    'username' => $account['name'],
                ];
            } else {
                throw new \Exception('Account page ID account not found.');
            }
        }
        throw new \Exception('Account page ID account not found.');
    }

    /**
     * Connecting to the server and retrieving the instagram business account id
     * @return string
     */
    public function getIgBusinessAccountId($accountId): string
    {
        $user = auth()->user();
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/v15.0/' . $accountId, [
            'query' => [
                'fields' => 'instagram_business_account',
                'access_token' => $user->token,
            ],
        ]);
        $json_response = json_decode($response->getBody(), true);

        if (isset($json_response['instagram_business_account'])) {
            return $json_response['instagram_business_account']['id'];
        } else {
            throw new \Exception('Business page ID account not found.');
        }
    }

    /**
     * @param Post $post
     * @return string
     */
    public static function uploadMedia(Post $post): string
    {
        LogService::log([
            'type' => Log::TYPE_SUCCESS,
            'model' => Post::class,
            'model_id' => $post->id,
            'message' => '2. UPLOADING MEDIA TO INSTAGRAM',
        ]);

        $client = new Client();
        $user = $post->user;

        try {
            $response = $client->post('https://graph.facebook.com/v15.0/' . $post->igAccount->business_id . '/media', [
                'query' => [
                    'image_url' => $post->image_url,
                    'caption' => $post->content,
                    'access_token' => $user->token,
                ],
            ]);
        } catch (RequestException $e) {

            $response = $e->getResponse()->getStatusCode();
            $body = $e->getResponse()->getBody();
            $message = json_decode($body, true)['error']['message'];

            if ($response === 400) {
                $post->delete();
            }

            LogService::log([
                'type' => Log::TYPE_ERROR,
                'model' => Post::class,
                'model_id' => $post->id,
                'message' => 'There was an error uploading media to ig from link.',
                'data' => json_encode([
                    'post_id' => $post->id,
                ]),
                'exception' => json_encode($message),
            ]);
            throw new \Exception('Error uploading media from link.');
        }

        $json_response = json_decode($response->getBody(), true);

        if (isset($json_response['id'])) {
            $post->ig_upload_id = $json_response['id'];
            $post->save();
            return $json_response['id'];
        } else {
            LogService::log([
                'type' => Log::TYPE_ERROR,
                'model' => Post::class,
                'model_id' => $post->id,
                'message' => 'There was an error getting the media id.',
                'data' => json_encode([
                    'post_id' => $post->id,
                ]),
            ]);
            throw new \Exception('Error uploading media.');
        }
    }

    /**
     * @param Post $post
     * @return string
     */
    public static function publishMedia(Post $post): string
    {
        LogService::log([
            'type' => Log::TYPE_SUCCESS,
            'model' => Post::class,
            'model_id' => $post->id,
            'message' => '2. PUBLISH MEDIA TO INSTAGRAM',
        ]);

        $client = new Client();
        $user = $post->user;

        try {
            $response = $client->post(
                'https://graph.facebook.com/v15.0/' . $post->igAccount->business_id . '/media_publish',
                [
                    'query' => [
                        'creation_id' => $post->ig_upload_id,
                        'access_token' => $user->token,
                    ],
                ]
            );
        } catch (\Exception $e) {
            LogService::log([
                'type' => Log::TYPE_ERROR,
                'model' => Post::class,
                'model_id' => $post->id,
                'message' => 'There was an error publishing media to ig.',
                'data' => json_encode([
                    'post_id' => $post->id,
                ]),
                'exception' => json_encode($e->getMessage()),
            ]);
            throw new \Exception('Error publishing media.');
        }

        $json_response = json_decode($response->getBody(), true);

        if (isset($json_response['id'])) {
            $post->posted = 1;
            $post->save();
            return $json_response['id'];
        } else {
            LogService::log([
                'type' => Log::TYPE_ERROR,
                'model' => Post::class,
                'model_id' => $post->id,
                'message' => 'There was an error getting the media id.',
                'data' => json_encode([
                    'post_id' => $post->id,
                ]),
            ]);
            throw new \Exception('Error uploading media.');
        }
    }

    /**
     * @param Post $post
     * @return string
     */
    public static function uploadPostToInstagram(Post $post)
    {
        LogService::log([
            'type' => Log::TYPE_SUCCESS,
            'model' => Post::class,
            'model_id' => $post->id,
            'message' => '1. START UPLOADING POST TO INSTAGRAM',
        ]);

        $uploadMedia = self::uploadMedia($post);

        if ($uploadMedia) {
            $publishMedia = self::publishMedia($post);
        }

        if ($publishMedia) {
            LogService::log([
                'type' => Log::TYPE_SUCCESS,
                'model' => Post::class,
                'model_id' => $post->id,
                'message' => 'Instagram post uploaded & published',
                'data' => json_encode([
                    'ig_id' => $publishMedia,
                ]),
            ]);
            return response()->json([
                'message' => 'Instagram post uploaded & published',
            ]);
        }

        LogService::log([
            'type' => Log::TYPE_ERROR,
            'model' => Post::class,
            'model_id' => $post->id,
            'message' => 'Instagram post NOT uploaded & published',
        ]);
        return response()->json([
            'message' => 'Instagram post NOT uploaded & published',
        ]);
    }

    public function requestMake(
        $method,
        $url,
        $data = [],
        $headers = [],
        $postId,
        $exceptionMessage = 'Error making request.'
    ) {
        $client = new Client();
        try {
            $response = $client->request($method, $url, [
                'headers' => $headers,
                'json' => $data,
            ]);
        } catch (\Exception $e) {
            LogService::log([
                'type' => Log::TYPE_ERROR,
                'model' => Post::class,
                'model_id' => $postId,
                'message' => $exceptionMessage,
                'data' => json_encode([
                    'post_id' => $postId,
                ]),
                'exception' => json_encode($e->getMessage()),
            ]);
            throw new \Exception($exceptionMessage);
        }
        return $response;
    }
}
