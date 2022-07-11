<?php
include ('../vendor/autoload.php');
use Adw\Auth\Config;
use Adw\Auth\User;

Config::setConfig([
    'baseUrlUserService' => 'http://localhost/adw-5g/user-service/public/api/v1/',
    'defaultLoginPageUrl' => 'http://adw-5g.test/login-internal/public/'
]);

try {
    $user = new User;
    $login = $user->login('enos.oberbrunner', 'password');
    $user->setToken($login->token);
    $result = $user->changePassword('kucing', 'password', 'password');
    var_dump($result);
} catch (Adw\Auth\Exceptions\PasswordException $e) {
    echo $e->getMessage();
}
