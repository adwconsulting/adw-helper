<?php

namespace Adw\PDC;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Exceptions\ConfigMissingException;
use Adw\Exceptions\InvalidTokenException;
use Adw\PDC\Config;

class VendorToken {

    protected $baseUrlPDC;
    protected $tenantClient;

    public function __construct()
    {
        $this->tenantClient = $this->client();
    }

    protected function client() {
        $this->baseUrlPDC = Config::getConfig('baseUrlPDC');
        if (!$this->baseUrlPDC) {
            throw new ConfigMissingException('Missing config PDC');
        }
        return new Client(['base_uri' => $this->baseUrlPDC]);
    }

    public function getToken(String $token = null) {
        if(!$token){
            $token = Config::getConfig('tokenPDC');
        }

        try {
            $response = $this->tenantClient->request('POST', Config::getConfig('UrlPDCToken'),[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'     => 'application/json'
                ],
                'verify' => false,
                'json' => [
                    'token'=> $token
                ]
            ]);
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);
            throw new InvalidTokenException($data->message);
        }
    }

    protected function responseHandler($response) {
        $data = $response->getBody()->getContents();
        $result = json_decode($data);
        return $result;
    }

    protected function errorHandler($e) {
        $data = $e->getResponse()->getBody()->getContents();
        return json_decode($data);
    }
}
