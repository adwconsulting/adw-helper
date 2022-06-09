<?php
include ('../vendor/autoload.php');
use Adw\Auth\Config;
use Adw\Auth\User;

Config::setConfig([
    'baseUrlUserService' => 'http://adw-5g.test/user-service/public/api/v1/',
    'defaultLoginPageUrl' => 'http://adw-5g.test/login-internal/public/'
]);


$user = new User;
$user->unsetToken();
if ($user->authenticated()) {
    $user->unsetToken();
}