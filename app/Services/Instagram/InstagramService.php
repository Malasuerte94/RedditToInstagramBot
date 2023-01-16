<?php

namespace App\Services\Instagram;
use App\Models\Post;
use App\Models\User;
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

    public function checkUserFbData()
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->account_id == null) {
            $user->account_id = $this->getAccountId();
            $user->save();
        }
        if ($user->business_id == null) {
            $user->business_id = $this->getIgBusinessAccountId();
            $user->save();
        }
    }

    /**
     * Connecting to the server and retrieving the instagram page id
     * @return string
     */
    public function getAccountId(): string
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
                return $account['id'];
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
    public function getIgBusinessAccountId(): string
    {
        $user = auth()->user();
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/v15.0/' . $user->account_id, [
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
    public function uploadMedia(Post $post): string
    {
        $client = new Client();
        $user = auth()->user();
        $this->checkUserFbData();

        $response = $client->post('https://graph.facebook.com/v15.0/' . $user->business_id . '/media', [
            'query' => [
                'image_url' => $post->image_url,
                'caption' => $post->hashtags,
                'access_token' => $user->token,
            ],
        ]);
        $json_response = json_decode($response->getBody(), true);

        if (isset($json_response['id'])) {
            $post->ig_upload_id = $json_response['id'];
            $post->save();
            return $json_response['id'];
        } else {
            throw new \Exception('Error uploading media.');
        }
    }

    /**
     * @param Post $post
     * @return string
     */
    public function publishMedia(Post $post): string
    {
        $client = new Client();
        $user = auth()->user();
        $this->checkUserFbData();

        $response = $client->post('https://graph.facebook.com/v15.0/' . $user->business_id . '/media_publish', [
            'query' => [
                'creation_id' => $post->ig_upload_id,
                'access_token' => $user->token,
            ],
        ]);
        $json_response = json_decode($response->getBody(), true);

        if (isset($json_response['id'])) {
            $post->posted = 1;
            $post->save();
            return $json_response['id'];
        } else {
            throw new \Exception('Error uploading media.');
        }
    }

    /**
     * @param Post $post
     * @return string
     */
    public function uploadPostToInstagram(Post $post)
    {
        $uploadMedia = $this->uploadMedia($post);
        if ($uploadMedia) {
            $publishMedia = $this->publishMedia($post);
        }
        if ($publishMedia) {
            return response()->json([
                'message' => 'Instagram post uploaded & published',
            ]);
        }
        return response()->json([
            'message' => 'Instagram post NOT uploaded & published',
        ]);
    }
}
