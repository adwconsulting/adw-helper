<?php

namespace Adw\File;

use Adw\File\Config;
use Illuminate\Http\UploadedFile\File;
use Validator;

class Upload
{
    protected $value;

    public function __construct($value){
        $this->value = $value;
    }

    public function __toString(){
        return (String) $this->value;
    }

    public function upload($path = null, $extType = null, $maxSize = null){
        if(!$path){
            $path = Config::getConfig('path');
        }
        if(!$extType){
            $extType = Config::getConfig('extType');
        }
        if(!$maxSize){
            $maxSize = Config::getConfig('maxSize');
        }
        $file = $this->value;
        $validate['file'] = $file;

        $validator = Validator::make($validate,[
              'file' => 'required|mimes:'.$extType.'|max:'.$maxSize,
        ]);

        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);
        }

        $fullPath = $file->store($path);
        $name = $file->getClientOriginalName();
        $hashName = $file->hashName();

        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "path" => $fullPath,
            "file" =>$hashName,
            "originalName"=>$name
        ]);
    }
}
