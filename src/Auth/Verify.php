<?php

namespace Adw\Auth;

use Adw\Auth\Config;
use Adw\Http\Response;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Adw\Auth\VerifyService;
use Carbon\Carbon;

class Verify
{
    public function checking(){
        $cookie = $_COOKIE;
        if(!$cookie){
            return response()->json(['message'=>'cookie kosong!'], 404);
        }
        $cookieVerify = $this->parseJwt($cookie['token']);

        $verifyService = new VerifyService();
        $checkAccess =  $verifyService->show($cookieVerify->id);

        if(!$checkAccess){
            return response()->json(['message'=>'token id tidak ditemukan!'], 404);
        }

        $expired = Config::getConfig('expiredMinute'); // inisiasi expired token dari config
        $now = Carbon::now();
        $lastAccess = Carbon::parse($checkAccess->last_requested_at);
        if($now->diffInMinutes($lastAccess) > $expired){
            return response()->json(['message'=>'token id expired!'], 400);
        }

        return $this->tenant($checkAccess->tenant_id);
    }

    public function tenant($uuid = null){
        $domain = Config::getConfig('domain');
        if(!$uuid){
            return response()->json(['message'=>'tenant id tidak boleh kosong!'], 404);
        }
        $fullDomain=$domain.'/api/v1/tenants/'.$uuid;
        $response = Http::get($fullDomain);
        return $response->body();
    }

    private function parseJwt($token) {
        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
    }
}
