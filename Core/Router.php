<?php
namespace App\Core;

class Router
{
    public function run()
    {
        // mettre un try catch
        $request = new \App\Core\Request($_GET, $_POST);
        $controller = $this->createController($request);
        $action = $this->createAction($request);
        $bookname = $this->createBookname($request);
        $controller->runAction($action, $bookname);
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
        $action = 'index';
        if ($request->existParam('get', 'action')) {
            $action = $request->getParam('get', 'action');
        }
        return $action;
    }

    public function createBookname(Request $request)
    {
        $bookname = 'the-last';
        if ($request->existParam('get', 'bookname')) {
            $bookname = $request->getParam('get', 'bookname');
        }
        return $bookname;
    }
    // Créer la fonction erreur exec, creer et appeler la vue
}