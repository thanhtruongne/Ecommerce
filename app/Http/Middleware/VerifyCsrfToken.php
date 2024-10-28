<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Symfony\Component\HttpFoundation\Cookie;
use Carbon\Carbon;
class VerifyCsrfToken extends Middleware
{
     /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;
    /**
     * The URIs that should be excluded from CSRF verification.
     *
      *  @var array
     */
    protected $except = [
        '/login',
        '/logout',
        'ckfinder/*',
    ];

    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');
            $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', $request->session()->token(), Carbon::now()->getTimestamp() +  60 * $config['lifetime'],
                $config['path'], $config['domain'], $config['secure'], true, false, $config['same_site'] ?? null
            )
        );

        return $response;
    }
}