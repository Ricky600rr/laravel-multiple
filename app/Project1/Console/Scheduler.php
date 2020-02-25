<?php
namespace App\Project1\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Common\Console\Contracts\Scheduler as SchedulerContract;

class Scheduler implements SchedulerContract
{
    public function schedule(Schedule $schedule)
    {
        /*
         * [ Sample ]
         * $schedule->command(\App\Project1\Console\Commands\Command::class, [])
         *          ->dailyAt('00:00');
         */
    }
}