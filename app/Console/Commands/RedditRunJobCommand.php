<?php

namespace App\Console\Commands;

use App\Jobs\RedditScrapperJob;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RedditRunJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reddit Run Job Command';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info('Working - Reddit Command ' . Carbon::now());
        RedditScrapperJob::dispatch();
    }
}
