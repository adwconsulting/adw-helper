<?php

namespace Adw\Formatter;

use Adw\Formatter\Config;

class Currency
{
    protected $value;
    
    public function __construct(float $value){
        $this->value = $value;
    }

    public function __toString(){
        return (float) $this->value;
    }

    /**
     * mengkonversi nominal int ke format currency.
     *
     * @param int $data
     * @return string
     */
    public function format($decimalPrecision = null, $thousandSeparator = null, $decimalSeparator = null, $prefixCurr = null){
        if(!$decimalPrecision){
            $decimalPrecision = Config::getConfig('decimalPrecision');
        }
        if(!$thousandSeparator){
            $thousandSeparator = Config::getConfig('thousandSeparator');
        }
        if(!$decimalSeparator){
            $decimalSeparator = Config::getConfig('decimalSeparator');
        }  

        if(!$prefixCurr){
            $prefixCurr = Config::getConfig('prefixCurr');
        }  

        return $prefixCurr.number_format($this->value,$decimalPrecision,$decimalSeparator,$thousandSeparator);
    }
    
}
