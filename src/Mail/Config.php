<?php

namespace Adw\Mail;
use Adw\Models\App\MstEmailSetting;

class Config
{
    public static function getConfig(String $config){
        try {
            $setting = MstEmailSetting::where('id',1)->first();
            if(!$setting){
                return 'data mail setting tidak ditemukan';
            }
            config([
                'mail.mailers.smtp' => [
                    'transport' => $config,
                    'host' => $setting->host,
                    'port' => $setting->port,
                    'username' => $setting->username,
                    'password' => $setting->password,
                ]
            ]);
        } catch (\Exception $e) {
            return 'error mail config';
        }
    }
}
