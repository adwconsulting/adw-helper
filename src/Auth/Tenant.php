<?php

namespace Adw\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Auth\Exceptions\ConfigMissingException;
use Adw\Auth\Exceptions\InvalidTenantException;

class Tenant {    

    protected $tenantBaseUrl;
    protected $tenantClient;

    public function __construct()
    {
        $this->tenantClient = $this->client();
    }

    protected function client() {
        $this->tenantBaseUrl = Config::getConfig('baseUrlTenantService');
        if (!$this->tenantBaseUrl) {
            throw new ConfigMissingException('Missing config tenant service');
        }
        return new Client(['base_uri' => $this->tenantBaseUrl]);
    }

    public function getById(string $id) {               
        try { 
            $response = $this->tenantClient->request('GET', 'tenants/'.$id);        
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);      
            throw new InvalidTenantException($data->message);
        }
    }

    protected function responseHandler($response) {
        $data = $response->getBody()->getContents();        
        $result = json_decode($data);
        return $result->data;
    }

    protected function errorHandler($e) {
        $data = $e->getResponse()->getBody()->getContents(); 
        return json_decode($data);
    }
}