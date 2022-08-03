<?php

namespace Adw\Middleware\Api;

use Adw\Http\Response;
use Closure;
use Illuminate\Http\Request;
use Adw\Auth\Exceptions\InvalidTokenException;
use App\Services\AuthService;

class VerifyToken
{

    public function handle(Request $request, Closure $next)
    {
        try {
            $authService = new AuthService;
            $result = $authService->verifyToken($request);            
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
