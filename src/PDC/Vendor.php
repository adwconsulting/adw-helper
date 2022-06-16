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

    public function getVendor(Int $buyerId = null, String $domain) {
        if(!$buyerId){
            $buyerId = Config::getConfig('buyerIdVendor');
        }
        if(!$domain){
            $domain = Config::getConfig('domainVendor');
        }
        $vendorToken = $this->vendorToken->getToken($buyerId,$domain);
        try {
            $response = $this->tenantClient->request('POST', Config::getConfig('UrlPDCVendor').'?buyerId='.$buyerId,[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'     => 'application/json'
                ],
                'json' => [
                    'accessToken'=> $vendorToken->resultData->accessToken,
                    'accessKey' => $vendorToken->resultData->accessKey
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
