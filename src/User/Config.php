<?php
namespace Adw\User;

class Config
{

    protected static $config = [
        'baseUrlPDC' => null,
        'UrlPDCToken' => 'security/token',
        'UrlPDCVendor' => 'BuyerProduct/findByBuyerOrVendor',
        'buyerIdVendor' => null,
        'domainVendor' => null,
        'baseUrlUser' => null,
        'urlUserRegister'=> 'api/v1/user/register'
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