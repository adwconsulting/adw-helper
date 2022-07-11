<?php

namespace Adw\Middleware\Api;

use Adw\Http\Response;
use Closure;
use Illuminate\Http\Request;
use Adw\Auth\User;
use Adw\Auth\Exceptions\InvalidTokenException;

class VerifyToken
{

    public function handle(Request $request, Closure $next)
    {
        try {
            $user = new User($request->bearerToken());
            $result = $user->verifyToken();
            if ($result) {
                return $next($request);
            } else {
                return Response::error('Invalid token');    
            }
        } catch (InvalidTokenException $e) {
            return Response::error($e->getMessage());
        }        
    }
}
