<?php

namespace Adw\Mail;
use Adw\Models\App\MstTemplateEmailSetting;
use Mail;

class Send
{
    public function setMail(String $email, String $subject, String $content){
        try {
            $tempEmail = MstTemplateEmailSetting::where('id',1)->first();
            if(!$tempEmail){
                return 'data template email setting tidak ditemukan';
            }
            $tempEmail->email = $email;
            $tempEmail->subject = $subject;
            $tempEmail->content = $content;

            $message = Mail::send('emails.aktivasiVendor', ['content' => $tempEmail], function ($m) use ($tempEmail) {
                $m->from($tempEmail->alias, $tempEmail->name);

                $m->to($tempEmail->email)->subject($tempEmail->subject)->bcc('yuwaka.adi@adw.co.id');
            });
            return $message;
        } catch (\Exception $e) {
            return Mail::failures();
        }
    }
}
