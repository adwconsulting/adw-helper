<?php
namespace Adw\Theme;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {
    
    public function register()
    {
        //
    }
    
    public function boot()
    {
        $this->publishes([
            base_path('vendor/yuwaka/helper/src/Theme/inspinia/assets') => public_path('inspinia/assets'),
        ]);
    }
}