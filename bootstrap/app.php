<?php
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

//$app->singleton(
//    Illuminate\Contracts\Http\Kernel::class,
//    App\Common\Http\Kernel::class
//);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Common\Console\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Common\Exception\Handler::class
);

return $app;