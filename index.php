<?php


namespace App;

require 'Autoloader.php';
Autoloader::register();

$router = new Model\Router;
$router->run();