<?php
namespace App\Common\Bootstrap\Contracts;

interface Bootstrap
{
    public function register();

    public function boot();
}