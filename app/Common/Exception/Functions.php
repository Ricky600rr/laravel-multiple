<?php
namespace App\Common\Exception;

use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

trait Functions
{
    protected function makeViewResponse(string $viewPath, HttpExceptionInterface $e): Response
    {
        return response()->view($viewPath, [
            'errors'           => new ViewErrorBag,
            'exception'        => $e,
        ], $e->getStatusCode(), $e->getHeaders());
    }
}