<?php
namespace Adw\File;

class Config
{

    protected static $config = [
        'path' => 'public/files',
        'extType'=>'doc,docx,pdf,jpeg,jpg,png,txt,csv',
        'maxSize'=>'2048'
    ];

    public static function setConfig(array $config){
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
