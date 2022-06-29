<?php

namespace Adw\Auth\Middleware\Api;

use Adw\Http\Response;
use Closure;
use Illuminate\Http\Request;

class ValidateToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken()) {
            return $next($request);
        } else {
            return Response::error('Missing token');
        }
    }
}
