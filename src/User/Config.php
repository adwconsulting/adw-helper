<?php
namespace Adw\User;

class Config
{

    protected static $config = [
        'baseUrlUser' => null
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
