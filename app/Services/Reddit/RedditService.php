<?php

namespace App\Services\Reddit;
use App\Models\post;
use App\Services\Instagram\InstagramTool;

class RedditService
{
    public $client;
    public $secret;
    public $app;
    public $subReddit;

    public function __construct()
    {
        $this->client = env('REDDIT_CLIENT_ID');
        $this->secret = env('REDDIT_CLIENT_SECRET');
        $this->app = env('REDDIT_APP');
        $this->subReddit = env('REDDIT_SUB');
        $this->getLatestPosts();
    }

    /**
     * Connecting to the server and retrieving the token
     * @return void
     */
    public function getLatestPosts(): void
    {
        $url = 'https://www.reddit.com/r/' . $this->subReddit . '/top/.json?limit=10';
        $options = [
            'http' => [
                'header' =>
                    "User-Agent: {$this->app}\r\n" .
                    'Authorization: Basic ' .
                    base64_encode("{$this->client}:{$this->secret}"),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $posts = json_decode($response, true)['data']['children'];

        foreach ($posts as $post) {
               $data = [
                    'subreddit' => $this->subReddit,
                    'image_url' => $post['data']['url'],
                    'author' => $post['data']['author'],
                    'hashtags' => InstagramTool::generateHashtags(20),
                ];
                Post::create($data);
        }
    }
}