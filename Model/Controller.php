<?php
namespace App\Model;

abstract class Controller
{
    private $action;
    protected $request;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    
    public function runAction($action, $bookname)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}($bookname);
        } else {
            $controllerClass = get_class($this);
            throw new \Exception("Action $action non définie dans la classe $controllerClass");
        }
    }

    public abstract function index($bookname);

    protected function generateView($dataView = array(), $action = null)
    {
        $actionView = $this->action;
        if ($action != null) {
            $actionView = $action;
        }
        $controllerClass = get_class($this);
        $controllerNamespace = substr($controllerClass, 0, strrpos($controllerClass, '\\'));
        $controllerView = substr(str_replace($controllerNamespace, "", $controllerClass), 1);
        $view = new View($actionView, $controllerView);
        $view->generate($dataView);
    }
    
    // Faire une fonction de redirection
}