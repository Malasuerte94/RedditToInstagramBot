<?php

namespace App\Services\Reddit;

use App\Models\RedditAutomation;

class RedditAutomationService
{
    public function startScrapping()
    {
        //foreach all automations where 'active' in automation is true
        $redditAutomations = RedditAutomation::where('active', true)->get();
        foreach ($redditAutomations as $redditAutomation) {
            try {
                $redditService = new RedditService($redditAutomation);
                $redditService->getLatestPosts();
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
