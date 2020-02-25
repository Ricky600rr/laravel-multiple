<?php
namespace App\Common\Exception;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use App\Common\Exception\Contracts\Handler as HandlerContract;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (!empty($handler = $this->getApplicationExceptionHandler()) && !empty($ret = $handler->unauthenticated($request, $exception))) {
            return $ret;
        }
        return parent::unauthenticated($request, $exception);
    }

    protected function renderHttpException(HttpExceptionInterface $e)
    {
        if (!empty($handler = $this->getApplicationExceptionHandler()) && !empty($ret = $handler->renderHttpException($e))) {
            return $ret;
        }
        return parent::renderHttpException($e);
    }

    private function getApplicationExceptionHandler(): ?HandlerContract
    {
        try {
            if (!empty($handler = app()->make(HandlerContract::class))) {
                return $handler;
            }
        } catch (BindingResolutionException $e) {
            error_log($e->getMessage());
        }
        return null;
    }
}