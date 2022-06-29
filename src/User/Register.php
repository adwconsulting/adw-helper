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

    public function __construct(string $token = null)
    {
        $this->userClient = $this->client($token);
    }

    protected function client(string $token = null) {
        $this->baseUrlUser = Config::getConfig('baseUrlUser');
        if (!$this->baseUrlUser) {
            throw new ConfigMissingException('Missing config API user');
        }
        $config = ['base_uri' => $this->baseUrlUser];
        if ($token) {
            $config['headers'] = ['Authorization' => 'Bearer '.$token];
        }
        return new Client($config);
    }

    public function setUser(array $data, $type = 'form_params') {
        try {
            $response = $this->userClient->request('POST', 'user/register',[
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
