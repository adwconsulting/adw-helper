<?php
namespace Adw\Formatter;

class Config
{

    protected static $config = [
        'thousandSeparator' => '.',
        'decimalSeparator'=>',',
        'decimalPrecision'=> 2,
        'prefixCurr'=>'Rp. ',
        'language'=>'id',
        'formatDate'=>'M-D-Y',
        'formatDateTime'=>'M-D-Y hh:mm',
        'formatTime'=>'hh:mm',
        'formatHumanDate'=>'dddd, D MMMM Y',
        'formatHumanDateTime'=>'dddd, D MMMM Y hh:mm',
        'autoNumericMin' => '-9223372036854775808',
        'autoNumericMax' => '9223372036854775807',
        'datepickerFormat' => 'dd-mm-yyyy',
        'satuanAngka'=> [
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        ],
        'satuanBilanganNol'=>'nol',
        'satuanBilanganKoma'=>'koma',
        'satuanBilanganBelasan'=> ' belas',
        'satuanBilanganPuluhan'=> ' puluh',
        'satuanBilanganRatus'=> 'seratus',
        'satuanBilanganRatusan'=> ' ratus',
        'satuanBilanganRibu'=> 'seribu',
        'satuanBilanganJutaan'=> ' juta',
        'satuanBilanganMilyar'=> ' milyar',
        'satuanBilanganTriliun'=> ' triliun',
        'satuanBilanganSeptiliun'=> ' septiliun',
    ];
    
    public static function setConfig(array $config){
        foreach($config as $index => $v){
            self::$config[$index] = $config[$index];
        }        
    }

    public static function getConfig($name=null){        
        if($name==null){
            return self::$config;
        }        
        return self::$config[$name];
    }
    
    public static function jsConfig(){
        $config = [
            'thousandSeparator' => self::$config['thousandSeparator'],
            'decimalSeparator' => self::$config['decimalSeparator'],
            'decimalPrecision' => self::$config['decimalPrecision'],
            'autoNumericMin' => self::$config['autoNumericMin'],
            'autoNumericMax' => self::$config['autoNumericMax'],
            'datepickerFormat' => self::$config['datepickerFormat'],
            'formatDate' => self::jsDateTimeFormat(self::$config['formatDate']),
            'formatDateTime' => self::jsDateTimeFormat(self::$config['formatDateTime']),
            'formatTime' => self::jsDateTimeFormat(self::$config['formatTime']),
            'formatHumanDate' => self::jsHumanDateTimeFormat(self::$config['formatHumanDate']),
            'formatHumanDateTime' => self::jsHumanDateTimeFormat(self::$config['formatHumanDateTime'])
        ];
        return 'var formatterConfig = '.json_encode($config);
    }
    
    
    private static function jsDateTimeFormat($config) {
        $format = [
            'M-D-Y' => '{m}-{d}-{Y}',
            'M-D-Y hh:mm' => '{m}-{d}-{Y} {H}:{i}',
            'hh:mm' => '{H}:{i}'
        ];
        return $format[$config];
    }
    
    private static function jsHumanDateTimeFormat($config) {
        $format = [
            'dddd, D MMMM Y' => '{l}, {d} {m} {Y}',
            'dddd, D MMMM Y hh:mm' => '{l}, {d} {m} {Y} {H}:{i}'
        ];
        return $format[$config];
    }
}