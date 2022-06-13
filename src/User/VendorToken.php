<?php

namespace Adw\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Exceptions\ConfigMissingException;
use Adw\Exceptions\InvalidTokenException;
use Adw\User\Config;

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

    public function getToken(Int $buyerId = null, String $domain = null) {
        if(!$buyerId){
            $buyerId = Config::getConfig('buyerIdVendor');
        }

        if(!$domain){
            $domain = Config::getConfig('domainVendor');
        }

        try {
            $response = $this->tenantClient->request('POST', Config::getConfig('UrlPDCToken'),[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'     => 'application/json'
                ],
                'json' => [
                    'buyerId'=> $buyerId,
                    'domain' => $domain,
                    'type' => 0
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
