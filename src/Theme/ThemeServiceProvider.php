<?php
namespace Adw\Theme;

use Illuminate\Support\ServiceProvider;
use Adw\Theme\Theme;
class ThemeServiceProvider extends ServiceProvider {
    
    public function register()
    {
        //
    }
    
    public function boot()
    {
        $this->publishes([
            dirname(__FILE__).'/'.Theme::getTemplate().'/assets' => public_path(Theme::getTemplate().'/assets'),
        ]);
    }
}