<?php

namespace Adw\Http;

class Response extends \Illuminate\Http\Response {
    
    private static function render($data, $message = 'Success retrieve data', $code = self::HTTP_OK) {
        if ($message) {
            $response['message'] = $message;
        }
        
        if ($data) {
            $response['data'] = $data;
        }

		return response()->json($response, $code);
    }
    
    public static function success($data, $message = null, $code = self::HTTP_OK) {
        return self::render($data, $message, $code);
    }
    
    public static function error($message = 'Something went wrong', $code = self::HTTP_BAD_REQUEST) {        
        if (is_array($message)) {
            $errorMessage = null;
            if (isset($message['message'])) {
                $errorMessage = $message['message'];
                unset($message['message']);
            }
            $data = $message;
            return self::render($data, $errorMessage, $code);
        } else {
            return self::render(null, $message, $code);
        }
    }
}