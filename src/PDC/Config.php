<?php
namespace Adw\PDC;

class Config
{

    protected static $config = [
        'baseUrlPDC' => null,
        'UrlPDCToken' => 'security/login',
        'UrlPDCVendor' => 'vendor/',
        'buyerIdVendor' => null,
        'domainVendor' => null,
        'tokenPDC'=> null
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
