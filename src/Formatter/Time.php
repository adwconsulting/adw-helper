<?php

namespace Adw\Formatter;
use Adw\Formatter\Config;
use Carbon\Carbon;

class Time
{
    protected $value;

    public function __construct($value){
        $this->value = $value;
    }

    public function __toString(){
        return (String) $this->value;
    }

    public function default($formatTime = null){
        if(!$formatTime){
            $formatTime = Config::getConfig('formatTime');
        }  
        $date = Carbon::parse($this->value);
        return $date->isoFormat($formatTime);
    }

    public function dateTime($formatDateTime = null){
        if(!$formatDateTime){
            $formatDateTime = Config::getConfig('formatDateTime');
        }  
        $date = Carbon::parse($this->value);
        return $date->isoFormat($formatDateTime);
    }

    public function humanTime($language = null, $formatHumanDateTime = null){
        if(!$formatHumanDateTime){
            $formatHumanDateTime = Config::getConfig('formatHumanDateTime');
        }  
        if(!$language){
            $language = Config::getConfig('language');
        } 
        Carbon::setLocale($language);
        $date = Carbon::parse($this->value);
        return $date->isoFormat($formatHumanDateTime);
    }

    public function timelapse($language = null){
        if(!$language){
            $language = Config::getConfig('language');
        } 
        Carbon::setLocale($language);
        $value = Carbon::parse($this->value);
        return $value->diffForHumans();
    }
}
