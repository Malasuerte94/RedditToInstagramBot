<?php

namespace App\Console\Commands;

use App\Jobs\InstagramAutomationJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InstagramRunJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run manually the Instagram Automation Job';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info('Working - Instagram Command ' . Carbon::now());
        InstagramAutomationJob::dispatch();
    }
}
