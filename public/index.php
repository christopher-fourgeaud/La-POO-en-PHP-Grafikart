<?php


require '../app/Autoloader.php';

App\Autoloader::register();

$app = \App\App::getInstance();

var_dump($app->getTable('Posts'));
var_dump($app->getTable('Users'));
var_dump($app->getTable('Categories'));
