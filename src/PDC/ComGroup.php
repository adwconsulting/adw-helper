<?php

namespace Adw\PDC;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Exceptions\ConfigMissingException;
use Adw\Exceptions\InvalidTenantException;
use Adw\PDC\Config;
use Adw\PDC\VendorToken;

class ComGroup {

    protected $baseUrlPDC;
    protected $tenantClient;

    public function __construct()
    {
        $this->tenantClient = $this->client();
        $this->vendorToken = new VendorToken;
    }

    protected function client() {
        $this->baseUrlPDC = Config::getConfig('baseUrlPDC');
        if (!$this->baseUrlPDC) {
            throw new ConfigMissingException('Missing config PDC');
        }
        return new Client(['base_uri' => $this->baseUrlPDC]);
    }

    public function getComGroup(String $token, String $comGroupParent = null) {
        if(!$token){
            $token = Config::getConfig('tokenPDC');
        }

        $vendorToken = $this->vendorToken->getToken($token);
        try {
            $response = $this->tenantClient->request('GET', Config::getConfig('UrlPDComGroup'),[
                'verify' => false,
                'headers' => [
                    'Authorization' => $vendorToken->tokenType.' '.$vendorToken->accessToken
                ],
                'query' => [
                    'comGroupParent'=> $comGroupParent
                ]
            ]);
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);
            throw new InvalidTenantException($data->message);
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
