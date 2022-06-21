<?php

namespace Adw\PDC;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Exceptions\ConfigMissingException;
use Adw\Exceptions\InvalidTenantException;
use Adw\PDC\Config;
use Adw\PDC\VendorToken;

class Vendor {

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

    public function getVendor(String $token, String $param, Int $vendorId = null) {
        if(!$token){
            $token = Config::getConfig('tokenPDC');
        }

        $vendorToken = $this->vendorToken->getToken($token);
        try {
            $response = $this->tenantClient->request('GET', Config::getConfig('UrlPDCVendor').$param,[
                'verify' => false,
                'headers' => [
                    'Authorization' => 'Bearer '.$vendorToken->accessToken
                ],
                'query' => [
                    'vendorId'=> $vendorId
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
