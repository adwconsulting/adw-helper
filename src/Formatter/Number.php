<?php

namespace Adw\Formatter;

use Adw\Formatter\Config;

class Number
{
    protected $value;

    public function __construct($value){
        $this->value = $value;
    }

    public function __toString(){
        return (String) $this->value;
    }

    /**
     * mengkonversi int ke format rupiah (default).
     *
     * @param string $data
     * @return string
     */
    public function string($decimalPrecision = null, $thousandSeparator = null, $decimalSeparator = null){        
        if(!$decimalPrecision){
            $decimalPrecision = Config::getConfig('decimalPrecision');
        }
        if(!$thousandSeparator){
            $thousandSeparator = Config::getConfig('thousandSeparator');
        }
        if(!$decimalSeparator){
            $decimalSeparator = Config::getConfig('decimalSeparator');
        }        
        return number_format($this->value, $decimalPrecision, $decimalSeparator, $thousandSeparator);
    }

    /**
     * mengkonversi string ke float (default).
     *
     * @param string $data
     * @return float
     */
    public function decimal($thousandSeparator = null, $decimalSeparator = null){
        if(!$thousandSeparator){
            $thousandSeparator = Config::getConfig('thousandSeparator');
        }
        if(!$decimalSeparator){
            $decimalSeparator = Config::getConfig('decimalSeparator');
        }  
        $replace = str_replace($decimalSeparator, $thousandSeparator, str_replace($thousandSeparator,'',$this->value));
        return $replace;
    }
}
