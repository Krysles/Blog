<?php
namespace App;

require 'Autoloader.php';
Autoloader::register();

// Select environment 'dev' or 'prod' and create file in Config directory
$router = new \App\Core\Router('dev'); 
$router->run();