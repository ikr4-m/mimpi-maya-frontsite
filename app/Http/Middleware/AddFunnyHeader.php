<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddFunnyHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Developed-By', 'munn@d04_1bu');
        $response->headers->set('X-Message-From-Developer', 'https://www.youtube.com/watch?v=Ib0VZY2dvWo');

        return $response;
    }
}
