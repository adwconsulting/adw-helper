<?php
include ('../vendor/autoload.php');
use Adw\Auth\Config;
use Adw\Auth\User;

Config::setConfig([
    'baseUrlUserService' => 'http://adw-5g.test/user-service/public/api/v1/'
]);
$user = new User;
$data = $user->login('enos.oberbrunner', 'password');
$user->setCookieToken($data->token);