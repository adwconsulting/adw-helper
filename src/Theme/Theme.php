<?php
namespace Adw\Theme;

use Adw\Models\App\MstProfile;

class Theme {
    
    protected static $template = 'inspinia';

    protected static $tenantProfile;
    
    public static function viewsPath() {
        return dirname(__FILE__).'/'.self::$template.'/views';
    }

    public static function setTemplate(string $template) {
        self::$template = $template;
    }

    public static function getTemplate() {
        return self::$template;
    }

    public static function profile() {
        if (!self::$tenantProfile) {
            $tenantProfile = MstProfile::firstOrFail();
        }
        return $tenantProfile;
    }
}