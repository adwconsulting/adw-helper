<?php
namespace Adw\Theme;

class Theme {
    
    protected static $template = 'inspinia';
    
    public static function viewsPath() {
        return base_path('vendor/yuwaka/helper/src/Theme/'.self::$template.'/views');
    }
}