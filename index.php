<?php
namespace App;

use \App\Core\Router;

require 'Autoloader.php';
Autoloader::register();

// Select environment 'dev' or 'prod' and create file in Config directory
$router = new Router('dev');
$router->run();