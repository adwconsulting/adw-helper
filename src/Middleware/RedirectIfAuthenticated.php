<?php

namespace Adw\Middleware;

use Closure;
use Illuminate\Http\Request;
use Adw\Auth\Config;
use Adw\Auth\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        try {
            $cookieName = Config::getConfig('cookieName');
            $user = new User;           
            $token = $request->session()->get($cookieName);
            if (!$token) {
                $token = $user->getCookieToken();
                if (!$token) {
                    throw new \Exception('Unknown token');
                }
                $request->session()->put($cookieName, $token);
            }
            $user->setToken($token);
            $result = $user->verifyToken();            
            if ($result) {
                return redirect()->route('home');
            }
        } catch (\Exception $e) {            
            $request->session()->forget($cookieName);            
        }   
        return $next($request);
    }
}
