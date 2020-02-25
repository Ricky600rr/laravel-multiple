<?php
namespace App\Common\Bootstrap\Providers;

use Illuminate\Support\ServiceProvider;
use App\Common\Bootstrap\Contracts\Bootstrap as BootstrapContract;

class BootProvider extends ServiceProvider
{
    private $bootstrap;

    public function register()
    {
        if (!empty($namespace = $this->detectApplication())) {
            if (class_exists($class = "\\App\\{$namespace}\\Bootstrap\Bootstrap") && is_subclass_of($class, BootstrapContract::class)) {
                $this->bootstrap = new $class($this->app);
                $this->bootstrap->register();
            }
        }
    }

    public function boot()
    {
        if (!is_null($this->bootstrap)) {
            $this->bootstrap->boot();
        }
    }

    private function detectApplication(): string
    {
        // ここで実行するアプリケーションに応じたNamespaceを特定する。
        return 'Project1';
    }
}