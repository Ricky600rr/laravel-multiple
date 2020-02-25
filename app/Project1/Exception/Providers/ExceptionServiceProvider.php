<?php
namespace App\Project1\Exception\Providers;

use Illuminate\Support\ServiceProvider;
use App\Common\Exception\Contracts\Handler as HandlerContract;
use App\Project1\Exception\Handler;

class ExceptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(HandlerContract::class, function () {
            return new Handler();
        });
    }
}