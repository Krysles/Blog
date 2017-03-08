<?php
namespace App\Model;

class Router
{
    public function run()
    {
        // mettre un try catch
        $request = new Request(array_merge($_GET, $_POST));
        $controller = $this->createController($request);
        $bookname = $this->createBookname($request);
        $action = $this->createAction($request);
        $controller->runAction($action);
        
        //debug($request);
        //debug($controller);

    }

    public function createController(Request $request)
    {
        $controller = 'Home';
        if ($request->existParams('controller')) {
            $controller = $request->getParams('controller');
            $controller = ucfirst(strtolower($controller));
        }
        $controllerClass = 'App\Controller\\' . $controller;
        $controllerFile = 'App/Controller/' . $controller . '.php';
        if (file_exists($controllerFile)) {
            $controller = new $controllerClass;
            $controller->setRequest($request);
            return $controller;
        } else {
            throw new \Exception("Fichier introuvable");
        }
    }

    public function createBookname(Request $request) {
        $bookname = null;
        if ($request->existParams('bookname')) {
            $bookname = $request->getParams('bookname');
        }
        return $bookname;
    }

    public function createAction(Request $request)
    {
        $action = 'index';
        if ($request->existParams('action')) {
            $action = $request->getParams('action');
        }
        return $action;
    }
    
    // Créer la fonction erreur exec, creer et appeler la vue
}