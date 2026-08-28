<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Adiciona proteções de navegador sem depender do servidor web.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy());
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Permissions-Policy', 'camera=(), geolocation=(), microphone=(), payment=()');

        return $response;
    }

    private function contentSecurityPolicy(): string
    {
        $scriptSources = ["'self'", 'https://cdn.jsdelivr.net'];
        $connectSources = ["'self'"];

        if (app()->environment('local')) {
            $scriptSources[] = 'http://localhost:5173';
            $connectSources[] = 'http://localhost:5173';
            $connectSources[] = 'ws://localhost:5173';
        }

        $directives = [
            "default-src 'self'",
            'base-uri \'self\'',
            'connect-src '.implode(' ', $connectSources),
            'font-src \'self\' data: https://fonts.gstatic.com',
            'form-action \'self\'',
            'frame-ancestors \'self\'',
            'img-src \'self\' data:',
            'object-src \'none\'',
            'script-src '.implode(' ', $scriptSources),
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
        ];

        if (app()->environment('production')) {
            $directives[] = 'upgrade-insecure-requests';
        }

        return implode('; ', $directives);
    }
}
