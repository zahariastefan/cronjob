<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 10;
    public $maxExceptions = 2; // that means that we can have 10 tries but ONLY TWO of them can be Exception!

//    public $backoff = [2, 10, 20];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        throw new \Exception('Failed');
        return $this->release(); //now the queue:work will try 3 times to do the job, but this release say to the worker
        // that he have to do the job again after 2 times but that is impossible because we have only 3 tries so it FAILED!
    }

    public function failed($e)
    {
        info('Failed!');
    }
}
