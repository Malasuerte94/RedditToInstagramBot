<?php

namespace App\Console\Commands;

use App\Jobs\InstagramAutomationJob;
use Illuminate\Console\Command;

class igjob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ig:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        InstagramAutomationJob::dispatch();
    }
}
