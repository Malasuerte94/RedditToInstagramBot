<?php

namespace App\Services\Instagram;
use App\Models\post;
use App\Models\User;
use App\Services\Instagram\InstagramTool;
use GuzzleHttp\Client;
use ValueError;

class InstagramService
{
    public $client;
    public $secret;
    public $user;

    public function __construct(User $user)
    {
        $this->client = config('instagram.instagram_id');
        $this->secret = config('instagram.instagram_secret');
        $this->user = $user;    
        $this->init();    
    }

    public function init()
    {
        if($this->user->token == null) {
            $this->user->token = $this->getToken();
            $this->user->save();
        }
        if($this->user->account_id == null) {
            return ($this->getTokenLong());
            $this->user->account_id = $this->getAccountId();
            $this->user->save();
        }
        if($this->user->page_id == null) {
            $this->user->page_id = $this->getIgBusinessAccountId();
            $this->user->save();
        }
    }


         /**
     * Get the instagram access token
     * @return string
     */
    public function getToken(): string
    {
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/oauth/access_token', [
            'query' => [
                'client_id' => $this->client,
                'client_secret' => $this->secret,
                'grant_type' => 'client_credentials',
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (!isset($responseBody['access_token'])) {
            throw new \Exception('Failed to get access token');
        }

        return $responseBody['access_token'];
    }

     /**
     * Get the fb long lived access token
     * @return string
     */
    public function getTokenLong(): string
    {
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/oauth/access_token', [
            'query' => [
                'grant_type' => 'fb_exchange_token',
                'client_id' => $this->client,
                'client_secret' => $this->secret,
                'fb_exchange_token' => $this->user->token,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (!isset($responseBody['access_token'])) {
            throw new \Exception('Failed to get access token');
        }

        return $responseBody['access_token'];
    }
    

    //  /**
    //  * Get the instagram access token
    //  * @return string
    //  */
    // public function getToken(): string
    // {
    //     $client = new Client();
    //     $response = $client->get('https://graph.facebook.com/oauth/access_token', [
    //         'query' => [
    //             'client_id' => $this->client,
    //             'client_secret' => $this->secret,
    //             'grant_type' => 'client_credentials',
    //         ],
    //     ]);

    //     $responseBody = json_decode($response->getBody(), true);

    //     if (!isset($responseBody['access_token'])) {
    //         throw new \Exception('Failed to get access token');
    //     }

    //     return $responseBody['access_token'];
    // }
    

    /**
     * Connecting to the server and retrieving the instagram page id
     * @return string
     */
    public function getAccountId(): string
    {
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/v15.0/me/accounts', [
            'query' => [
                'access_token' => $this->user->token,
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
        $client = new Client();
        $response = $client->get('https://graph.facebook.com/v15.0/'.$this->user->account_id, [
            'query' => [
                'fields' => 'instagram_business_account',
                'access_token' => $this->user->token,
            ],
        ]);
        $json_response = json_decode($response->getBody(), true);

  
        if (isset($json_response['instagram_business_account'])) {
            return $json_response['instagram_business_account']['id'];
        } else {
            throw new \Exception('Business page ID account not found.');
        }
    
    }


}
