<?php

namespace App\Console;

use App\Jobs\InstagramAutomationJob;
use App\Jobs\RedditScrapperJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping();
            
        // uncomment this line to see if the scheduler is working
        //$schedule->call(function () {Log::info('Working');})->everyMinute();

        $schedule->job(new RedditScrapperJob)->hourly();
        $schedule->job(new InstagramAutomationJob)->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
