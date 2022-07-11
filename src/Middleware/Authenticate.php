<?php

namespace Adw\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;
use Adw\Auth\Config;
use Adw\Auth\User;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $cookieName = Config::getConfig('cookieName');
            if (!Auth::check()) {
                $user = new User();
                $token = $request->session()->get($cookieName);
                $user->setToken($token);
                $userInfo = $user->info();                    
                if (!Auth::loginUsingId($userInfo->id)) {
                    throw new \Exception('User not found');
                }                   
            }
            return $next($request);
        } catch (\Exception $e) {
            Auth::logout();
            $token = $request->session()->forget($cookieName);
            return redirect()->to(config('param.default_login_page_url'));
        }
    }
}
