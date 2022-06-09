<?php

namespace Adw\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Adw\Exceptions\ConfigMissingException;
use Adw\Exceptions\InvalidRegisterException;
use Adw\User\Config;

class Register {

    protected $baseUrlUser;
    protected $userClient;

    public function __construct()
    {
        $this->userClient = $this->client();
    }

    protected function client() {
        Config::setConfig([
            'baseUrlUser' => env('BASE_URL_USER')
        ]);
        $this->baseUrlUser = Config::getConfig('baseUrlUser');
        if (!$this->baseUrlUser) {
            throw new ConfigMissingException('Missing config API user');
        }
        return new Client(['base_uri' => $this->baseUrlUser]);
    }

    public function setUser(array $data, $type = 'form_params') {
        try {
            $response = $this->userClient->request('POST', Config::getConfig('urlUserRegister'),[
                $type => $data
            ]);
            return $this->responseHandler($response);
        } catch (ClientException $e) {
            $data = $this->errorHandler($e);
            throw new InvalidRegisterException($data->message);
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
