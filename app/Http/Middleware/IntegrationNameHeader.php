<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IntegrationNameHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->hasHeader('X-Integration-Name')) {
            throw new \InvalidArgumentException(
                message: 'The request must contain the X-Integration-Name header',
                code: Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
