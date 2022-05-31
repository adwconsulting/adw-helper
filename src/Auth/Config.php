<?php
namespace Adw\Auth;

class Config
{

    protected static $config = [
        'domain' => 'http://tenant-service.test',
        'expiredMinute' => 3000
    ];

    public static function setConfig($config){
        self::$config = $config;
    }

    public static function getConfig($name){
        return self::$config[$name];
    }
}
