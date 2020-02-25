<?php
namespace App\Common\Console\Contracts;

use Illuminate\Console\Scheduling\Schedule;

interface Scheduler
{
    public function schedule(Schedule $schedule);
}