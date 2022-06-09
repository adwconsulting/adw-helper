<?php
namespace Adw\Auth;

class Config
{

    protected static $config = [
        'defaultLoginPageUrl' => null,
        'baseUrlTenantService' => null,
        'baseUrlUserService' => null,
        'cookieName' => 'ADW-TOKEN',
        'expiredMinute' => 3000
    ];

    public static function setConfig($config){
        foreach($config as $index => $v){
            self::$config[$index] = $config[$index];
        }
    }

    public static function getConfig($name=null){
        if($name==null){
            return self::$config;
        }
        return self::$config[$name];
    }
}
