<?php
namespace App\Common\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Common\Console\Contracts\Scheduler as SchedulerContract;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        /*
         * [ Sample ]
         * $schedule->command(\App\Common\Commands\Command::class, [])
         *          ->dailyAt('00:00');
         */

        try {
            if (!empty($scheduler = app()->make(SchedulerContract::class))) {
                $scheduler->schedule($schedule);
            }
        } catch (BindingResolutionException $e) {
            error_log($e->getMessage());
        }
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}