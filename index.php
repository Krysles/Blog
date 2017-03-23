<?php
namespace App;

require 'Autoloader.php';
Autoloader::register();

$router = new \App\Core\Router('dev'); // dev or prod
$router->run();