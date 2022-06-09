<?php

namespace Adw\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Auth\Exceptions\ConfigMissingException;
use Adw\Auth\Exceptions\InvalidTenantException;

class User {    

    protected $userBaseUrl;
    protected $userClient;
    protected $defaultLoginPageUrl;
    protected $cookieName;

    public function __construct(string $token = null)
    {
        $this->userClient = $this->client($token);
        $this->defaultLoginPageUrl = Config::getConfig('defaultLoginPageUrl');
        $this->cookieName = Config::getConfig('cookieName');
    }

    protected function client(string $token = null) {
        $this->userBaseUrl = Config::getConfig('baseUrlUserService');
        if (!$this->userBaseUrl) {
            throw new ConfigMissingException('Missing config user service');
        }
        $config = ['base_uri' => $this->userBaseUrl];
        if ($token) {
            $config['headers'] = ['Authorization' => 'Bearer '.$token];
        }
        return new Client($config);
    }

    public function login(string $username, string $password, array $other = []) {        
        try { 
            $credetial = [
                'username' => $username,
                'password' => $password
            ];
            if ($other) {
                $credetial = array_merge($credetial, $other);
            }
            $response = $this->userClient->request('POST', 'auth/login', [
                'form_params' => $credetial
            ]);        
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);      
            throw new InvalidLoginException($data->message);
        }
    }
    
    public function getTenant() {               
        try { 
            $response = $this->userClient->request('GET', 'user/tenant');        
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);                 
            throw new InvalidTenantException($data->message);
        }
    }

    public function authenticated($redirect = null) {
        $token = $this->getToken();
        if (!$token) {
            if ($redirect === false) {
                return false;
            } else {
                if ($redirect) {
                    header('Location: '.$redirect);
                } else {
                    if (!$this->defaultLoginPageUrl) {
                        return false;                        
                    }
                    header('Location: '.$this->defaultLoginPageUrl);
                }
            }
        }
        return true;
    }

    public function getToken() {
        return !empty($_COOKIE[$this->cookieName]) ? $_COOKIE[$this->cookieName] : null;
    }    

    public function setToken($token) {
        setcookie($this->cookieName, $token, null, '/');
        return true;
    }

    public function unsetToken() {
        $token = $this->getToken();
        if ($token) {
            unset($_COOKIE[$this->cookieName]);
        }
        return true;
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