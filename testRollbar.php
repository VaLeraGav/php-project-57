<?php

require 'vendor/autoload.php';

use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

Rollbar::init(
    array(
        'access_token' => '7b7748ae9dc24b6f94b89ea6637a76fc',
        'environment' => 'production'
    )
);

//отправляет успешная попытка
//Rollbar::log(Level::info(), 'Test info message Rollbar');

// отправляет на Rollbar  ошибку
//throw new Exception('Test Rollbar');
