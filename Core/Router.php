<?php
namespace App\Core;

class Router
{
    private static $environment;

    public function __construct($environment)
    {
        self::$environment = $environment;
    }

    public static function getEnvironment()
    {
        return self::$environment;
    }

    public function run()
    {
        // mettre un try catch
        try {
            $request = new \App\Core\Request($_GET, $_POST, $_FILES);
            $controller = $this->createController($request);
            $action = $this->createAction($request);
            $controller->runAction($action);
        } catch (\Exception $e) {
            $this->error($e);
        }
    }

    public function createController(Request $request)
    {
        $controller = 'Home';
        if ($request->existParam('get', 'controller')) {
            $controller = $request->getParam('get', 'controller');
            $controller = ucfirst(strtolower($controller));
        }
        $controllerClass = 'App\Controller\\' . $controller;
        $controllerFile = 'Controller/' . $controller . '.php';
        if (file_exists($controllerFile)) {
            $controller = new $controllerClass;
            $controller->setRequest($request);
            return $controller;
        } else {
            throw new \Exception("Fichier introuvable");
        }
    }

    public function createAction(Request $request)
    {
        $action = 'read';
        if ($request->existParam('get', 'action')) {
            $action = $request->getParam('get', 'action');
        }
        return $action;
    }

    private function error(\Exception $e)
    {
        // ajouter vue erreur pour l'affichage d'une 404
        echo $e->getMessage();
    }
}