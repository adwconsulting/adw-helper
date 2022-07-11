<?php

namespace Adw\Middleware;

use Closure;
use Illuminate\Http\Request;
use Adw\Auth\Config;
use Adw\Auth\User;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
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
                return $next($request);
            } else {
                throw new \Exception('Token invalid');                         
            }
        } catch (\Exception $e) {            
            $request->session()->forget($cookieName);
            return redirect()->to(config('param.default_login_page_url'));
        }        
    }
}
