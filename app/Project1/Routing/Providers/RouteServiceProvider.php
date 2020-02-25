<?php
namespace App\Project1\Routing\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->addApplicationRoutes();
    }

    private function addApplicationRoutes()
    {
        Route::middleware('web')->group(function() {
            Route::get('/', function () {
                return 'OK';
            });
        });
    }
}