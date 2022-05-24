<?php

namespace Adw\Formatter;
use Adw\Formatter\Config;
use Carbon\Carbon;

class Date
{
    protected $value;

    public function __construct($value){
        $this->value = $value;
    }

    public function __toString(){
        return (String) $this->value;
    }

    public function default($formatDate = null){
        if(!$formatDate){
            $formatDate = Config::getConfig('formatDate');
        }        
        $date = Carbon::parse($this->value);
        return $date->isoFormat($formatDate);
    }

    public function humanDate($language = null, $formatDate = null){
        if(!$formatHumanDate){
            $formatHumanDate = Config::getConfig('formatHumanDate');
        } 
        if(!$language){
            $language = Config::getConfig('language');
        } 
        Carbon::setLocale($language);
        $date = Carbon::parse($this->value);
        return $date->isoFormat($formatHumanDate);
    }
}
