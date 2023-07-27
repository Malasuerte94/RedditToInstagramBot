<?php

namespace App\Services\Instagram;

use App\Models\InstagramAutomation;
use App\Models\Log;
use App\Models\Post;
use App\Services\LogService;
use Carbon\Carbon;

class InstagramAutomationService
{
    public function startUploading()
    {

        $instagramAutomations = InstagramAutomation::where('active', true)->get();

        LogService::log([
            'type' => Log::TYPE_INFO,
            'model' => InstagramService::class,
            'message' => 'Start uploading - Active: ' . $instagramAutomations->count(),
            'data' => json_encode(Carbon::now()),
        ]);

        foreach ($instagramAutomations as $instagramAutomation) {
            $post = Post::where([
                'ig_account_id' => $instagramAutomation->ig_account_id,
                'reddit_scraper_id' => $instagramAutomation->reddit_scraper_id,
            ])
                ->notPosted()
                ->confirmed()
                ->first();

            if (!$post) {
                LogService::log([
                    'type' => Log::TYPE_INFO,
                    'model' => InstagramService::class,
                    'message' => 'No post to upload!',
                    'data' => json_encode([
                        'ig_account_id' => $instagramAutomation->ig_account_id,
                        'reddit_scraper_id' => $instagramAutomation->reddit_scraper_id,
                    ]),
                ]);
                continue;
            }

            try {
                LogService::log([
                    'type' => Log::TYPE_INFO,
                    'model' => InstagramService::class,
                    'message' => 'Trying to upload post',
                    'data' => json_encode([
                        'post_id' => $post->id,
                        'ig_account_id' => $instagramAutomation->ig_account_id,
                        'reddit_scraper_id' => $instagramAutomation->reddit_scraper_id,
                    ]),
                ]);
                InstagramService::uploadPostToInstagram($post);
            } catch (\Exception $e) {
                LogService::log([
                    'type' => Log::TYPE_ERROR,
                    'model' => InstagramService::class,
                    'message' => 'Cant upload post to instagram',
                    'data' => json_encode([
                        'post_id' => $post->id,
                        'ig_account_id' => $instagramAutomation->ig_account_id,
                        'reddit_scraper_id' => $instagramAutomation->reddit_scraper_id,
                    ]),
                    'exception' => json_encode($e),
                ]);
                continue;
            }
        }
    }
}
