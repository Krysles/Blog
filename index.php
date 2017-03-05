<?php
function debug($params) {
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
}
require 'App/Autoloader.php';
App\Autoloader::register();

$router = new App\Model\Router;
$router->run();