<?php

namespace App\Services\Reddit;

use App\Models\Hashtag;
use App\Models\IgAccount;
use App\Models\Log;
use App\Models\post;
use App\Models\RedditAutomation;
use App\Models\RedditScraper;
use App\Services\Instagram\InstagramTool;
use App\Services\LogService;

class RedditService
{
    public $client;
    public $secret;
    public $app;
    public $subReddit;
    public $redditAutomation;
    public IgAccount $igAccount;
    public RedditScraper $redditScrapper;
    public Hashtag $hashtag;

    public function __construct(RedditAutomation $reddit)
    {
        $this->client = env('REDDIT_CLIENT_ID');
        $this->secret = env('REDDIT_CLIENT_SECRET');
        $this->app = env('REDDIT_APP');

        $this->redditAutomation = $reddit;
        $this->igAccount = $this->redditAutomation->igAccount;
        $this->redditScrapper = $this->redditAutomation->redditScraper;
        $this->hashtag = $this->redditAutomation->hashtag;

        $this->getLatestPosts();
    }

    /**
     * Connecting to the server and retrieving the token
     * @return void
     */
    public function getLatestPosts(): void
    {
        $url =
            'https://www.reddit.com/r/' .
            $this->redditScrapper->subreddit .
            '/' .
            $this->redditScrapper->filter_by .
            '/.json?limit=' .
            $this->redditScrapper->limit;
        $options = [
            'http' => [
                'header' =>
                    "User-Agent: {$this->app}\r\n" .
                    'Authorization: Basic ' .
                    base64_encode("{$this->client}:{$this->secret}"),
            ],
        ];
        $context = stream_context_create($options);
        try {
            $response = file_get_contents($url, false, $context);
        } catch (\Exception $e) {
            LogService::log([
                'model_type' => RedditService::class,
                'model_id' => $this->redditAutomation->id,
                'type' => Log::TYPE_ERROR,
                'message' => 'Cant get latest posts from reddit',
                'exception' => json_encode($e),
                'data' => $url,
            ]);
            $this->redditAutomation->update(['active' => false]);
            return;
        }

        $posts = json_decode($response, true)['data']['children'];

        foreach ($posts as $post) {
            $file_extension = pathinfo($post['data']['url'], PATHINFO_EXTENSION);
            if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $data = [
                    'user_id' => $this->igAccount->user_id,
                    'ig_account_id' => $this->igAccount->id,
                    'reddit_scraper_id' => $this->redditScrapper->id,
                    'hashtag_id' => $this->hashtag->id,
                    'image_url' => $post['data']['url'],
                    'author' => $post['data']['author'],
                    'content' => InstagramTool::generateCaption(
                        $this->hashtag,
                        $this->igAccount,
                        $post['data']['author'],
                        20
                    ),
                ];
                Post::withTrashed()->firstOrCreate(
                    ['author' => $data['author'], 'image_url' => $data['image_url']],
                    $data
                );
            } else {
                LogService::log([
                    'model_type' => RedditService::class,
                    'model_id' => $this->redditAutomation->id,
                    'type' => Log::TYPE_INFO,
                    'message' => 'File extension not supported',
                ]);
            }
        }
    }
}
