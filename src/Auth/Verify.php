<?php

namespace Adw\Auth;

use Adw\Auth\Config;
use Adw\Http\Response;
use Adw\Auth\Exceptions\InvalidTokenException;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Verify
{
    public $verifyService;
    public function __construct() {

    }

    public function checking(){
        // $request = new Request();
        // session(['key' => 'value']);
        // print_r($_SESSION);die();

        $cookie = $_COOKIE;
        if(!$cookie){
            return response()->json(['message'=>'cookie kosong!'], 404);
        }
        $cookieVerify = $this->parseJwt($cookie['token']);

        $token = $this->token($cookieVerify->id);
        if(!$token->successful()){
            throw new InvalidTokenException("token id expired!");
        }


        // $verifyService = new VerifyService();
        // $checkAccess =  $verifyService->show($cookieVerify->id);

        // if(!$checkAccess){
        //     return response()->json(['message'=>'token id tidak ditemukan!'], 404);
        // }

        // $expired = Config::getConfig('expiredMinute'); // inisiasi expired token dari config
        // $now = Carbon::now();
        // $lastAccess = Carbon::parse($checkAccess->last_requested_at);
        // if($now->diffInMinutes($lastAccess) > $expired){
        //     return response()->json(['message'=>'token id expired!'], 400);
        // }

        return $this->tenant($checkAccess->tenant_id);
    }

    public function token($token){
        $domain = Config::getConfig('domainToken');
        $fullDomain=$domain.'/api/validationToken/'.$token;
        $response = Http::get($fullDomain);
        return $response;
    }

    public function tenant($uuid){
        $domain = Config::getConfig('domainTenant');
        $fullDomain=$domain.'/api/v1/tenants/'.$uuid;
        $response = Http::get($fullDomain);
        $responseArray = $response->json();
        $responseArrayTo = json_encode($responseArray['data']);
        return $responseArrayTo;
    }

    private function parseJwt($token) {
        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        return $jwtPayload;
    }
}
