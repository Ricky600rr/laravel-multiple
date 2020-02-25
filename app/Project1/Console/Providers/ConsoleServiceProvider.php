<?php
namespace App\Project1\Console\Providers;

use ReflectionClass;
use ReflectionException;
use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use App\Common\Console\Contracts\Scheduler as SchedulerContract;
use App\Project1\Console\Scheduler;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $commands = [];

    public function register()
    {
        $this->loadCommands();

        $this->app->bind(SchedulerContract::class, function () {
            return new Scheduler();
        });
    }

    private function loadCommands()
    {
        foreach ($this->commands as $command) {
            try {
                if (is_subclass_of($command, Command::class) && ! (new ReflectionClass($command))->isAbstract()) {
                    Artisan::starting(function ($artisan) use ($command) {
                        $artisan->resolve($command);
                    });
                }
            } catch (ReflectionException $e) {
                error_log($e->getMessage());
            }
        }
    }
}