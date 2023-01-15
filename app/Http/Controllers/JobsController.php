<?php

namespace App\Http\Controllers;

use App\Jobs\RedditScrapperJob;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Event\Terminated;

class JobsController extends Contructor 
{
    //@TODO Still working on this one
    public function startRedditScrapperJob()
    {
        $job = (new RedditScrapperJob)->onQueue('jobs');
        dispatch($job);
    }

    public function stopRedditScrapperJob()
    {
        $job = (new RedditScrapperJob)->onQueue('jobs');
        $job->terminate();
    }
}
