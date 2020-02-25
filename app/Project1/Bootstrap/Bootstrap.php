<?php
namespace App\Project1\Bootstrap;

use Illuminate\Support\ServiceProvider;
use App\Common\Bootstrap\Contracts\Bootstrap as BootstrapContract;
use App\Project1\Console\Providers\ConsoleServiceProvider;
use App\Project1\Exception\Providers\ExceptionServiceProvider;
use App\Project1\Routing\Providers\RouteServiceProvider;

class Bootstrap implements BootstrapContract
{
    private $app;

    private $providers = [
        ExceptionServiceProvider::class,
        ConsoleServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function register()
    {
        $this->registerApplicationProviders();
    }

    public function boot()
    {
        $this->bootApplicationProviders();
    }

    private function registerApplicationProviders()
    {
        foreach ($this->providers as $position => $provider) {
            $instance = new $provider($this->app);
            $instance->register();

            $this->providers[$position] = $instance;
        }
    }

    private function bootApplicationProviders()
    {
        foreach ($this->providers as $provider) {
            if ($provider instanceof ServiceProvider) {
                if (method_exists($provider, 'boot')) {
                    $provider->boot();
                }
            } else {
                error_log('$provider is not service provider.');
            }
        }
    }
}