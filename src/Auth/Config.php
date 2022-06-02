<?php
namespace Adw\Auth;

class Config
{

    protected static $config = [
        'baseUrlTenantService' => null,
        'baseUrlUserService' => null,
        'expiredMinute' => 3000
    ];

    public static function setConfig($config){
        self::$config = $config;
    }

    public static function getConfig($name){
        return self::$config[$name];
    }
}
