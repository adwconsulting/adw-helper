<?php

namespace Adw\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Adw\Auth\Config;

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
        $cookieName = Config::getConfig('cookieName');            
        $token = $request->session()->get($cookieName);
        if ($token) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
