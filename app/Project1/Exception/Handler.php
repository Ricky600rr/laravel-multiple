<?php
namespace App\Project1\Exception;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use App\Common\Exception\Contracts\Handler as HandlerContract;
use App\Common\Exception\Functions as ExceptionFunctions;

class Handler implements HandlerContract
{
    use ExceptionFunctions;

    public function unauthenticated($request, AuthenticationException $e): ?Response
    {
        return null;
    }

    public function renderHttpException(HttpExceptionInterface $e): ?Response
    {
        return $this->makeViewResponse('template.dir.path', $e);
    }
}