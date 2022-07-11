<?php

namespace Adw\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Auth\Exceptions\ConfigMissingException;
use Adw\Auth\Exceptions\InvalidTenantException;
use Adw\Auth\Exceptions\InvalidLoginException;
use Adw\Auth\Exceptions\InvalidTokenException;
use Adw\Auth\Exceptions\PasswordException;
use Adw\Http\Response;

class User {    

    const TYPE_INTERNAL = 'internal';
    const TYPE_EXTERNAL = 'external';

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

    public function setToken(string $token) {
        $this->userClient = $this->client($token);
    }

    public function login(string $username, string $password, array $other = []) {        
        try { 
            $credential = [
                'username' => $username,
                'password' => $password
            ];
            if ($other) {
                $credential = array_merge($credential, $other);
            }
            $response = $this->userClient->request('POST', 'auth/login', [
                'form_params' => $credential
            ]);        
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);      
            throw new InvalidLoginException($data->message);
        }
    }

    public function changePassword(string $oldPassword, string $newPassword, string $confirmPassword) {
        try { 
            $response = $this->userClient->request('PUT', 'password', [
                'form_params' => [
                    'old_password' => $oldPassword,
                    'new_password' => $newPassword,
                    'confirm_password' => $confirmPassword
                ]
            ]);        
            if ($response->getStatusCode() == Response::HTTP_OK) {
                return true;
            } else {
                return false;
            }
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);             
            throw new PasswordException($data->message);
        }
    }

    public function logout() {
        try { 
            $response = $this->userClient->request('GET', 'logout');        
            if ($response->getStatusCode() == Response::HTTP_OK) {
                return true;
            } else {
                return false;
            }
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);                 
            throw new InvalidTenantException($data->message);
        }
    }

    public function verifyToken() {
        try { 
            $response = $this->userClient->request('GET', 'auth/token');        
            if ($response->getStatusCode() == Response::HTTP_OK) {
                return true;
            } else {
                return false;
            }
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);                 
            throw new InvalidTokenException($data->message);
        }
    }
    
    public function info() {
        try { 
            $response = $this->userClient->request('GET', 'me');        
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);                 
            throw new InvalidTenantException($data->message);
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
        $token = $this->getCookieToken();
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

    public function getCookieToken() {
        return !empty($_COOKIE[$this->cookieName]) ? $_COOKIE[$this->cookieName] : null;
    }    

    public function setCookieToken($token) {
        setcookie($this->cookieName, $token, null, '/');
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