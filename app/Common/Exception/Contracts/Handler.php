<?php
namespace App\Common\Exception\Contracts;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

interface Handler
{
    public function unauthenticated($request, AuthenticationException $e): ?Response;

    public function renderHttpException(HttpExceptionInterface $e): ?Response;
}