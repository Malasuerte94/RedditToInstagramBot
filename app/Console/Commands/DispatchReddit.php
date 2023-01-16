<?php

namespace App\Console\Commands;

use App\Services\Reddit\RedditService;
use Illuminate\Console\Command;

class DispatchReddit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:reddit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a request to reddit and scrap the latest posts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $redditScrapper = new RedditService();
        $redditScrapper->getLatestPosts();
        return Command::SUCCESS;
    }
}
