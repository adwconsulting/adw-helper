<?php
namespace Adw\Theme;

class Theme {
    
    protected static $template = 'inspinia';
    
    public static function viewsPath() {
        return dirname(__FILE__).'/'.self::$template.'/views';
    }

    public static function setTemplate(string $template) {
        self::$template = $template;
    }

    public static function getTemplate() {
        return self::$template;
    }
}