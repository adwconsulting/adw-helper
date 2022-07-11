<?php

namespace Adw\Middleware;
use Illuminate\Http\Request;
use Closure;
use Adw\Auth\Config;
use Adw\Auth\User;
use Illuminate\Support\Facades\DB;

class Connect
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $cookieName = Config::getConfig('cookieName');
            $user = new User;
            $token = $request->session()->get($cookieName);
            $user->setToken($token);
            $tenant = $user->getTenant();                
            config([
                'database.connections.pgsql' => [
                    'driver' => 'pgsql',
                    'url' => env('DATABASE_URL'),
                    'host' => (!empty($tenant)) ? $tenant->db_host : null,
                    'port' => env('DB_PORT', '5433'),
                    'database' => (!empty($tenant)) ? $tenant->db_name : null,
                    'username' => (!empty($tenant)) ? $tenant->db_user : null,
                    'password' => (!empty($tenant)) ? $tenant->db_password : null,
                    'charset' => 'utf8',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'schema' => 'public',
                    'sslmode' => 'prefer',
                ]
            ]);
            DB::connection('pgsql');
            return $next($request);
        } catch (\Exception $e) {
            $request->session()->forget($cookieName);
            return redirect()->to(config('param.default_login_page_url'));
        }
    }
}
