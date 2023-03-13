<?php

namespace App\Services\Instagram;

use App\Models\InstagramAutomation;
use App\Models\Log;
use App\Models\Post;
use App\Services\LogService;

class InstagramAutomationService
{
    public function startUploading()
    {
        $instagramAutomations = InstagramAutomation::where('active', true)->get();

        foreach ($instagramAutomations as $instagramAutomation) {
            $post = Post::where([
                'ig_account_id' => $instagramAutomation->ig_account_id,
                'reddit_scraper_id' => $instagramAutomation->reddit_scraper_id,
            ])->notPosted()->confirmed()->first();

            if(!$post) {
                continue;
            }

            try {
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
