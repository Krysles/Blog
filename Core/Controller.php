<?php
namespace App\Core;

use App\Model\User;
use \App\Core\View;

abstract class Controller
{
    private $action;
    protected $request;
    // Attribut de sécurité par défaut
    protected $readmin = User::VISITOR;
    protected $readmax = User::ADMIN;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    
    public function runAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->action($this->action);
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "L'action demandée n'existe pas."));
            header('Location: /');
            exit();
        }
    }

    public function action($action) {
        $this->action = $action;
        if (($this->{$action.'max'} >= $this->request->getSession()->getAttribut('auth')->getRole()) && ($this->{$action.'min'} <= $this->request->getSession()->getAttribut('auth')->getRole())) {
            $this->{$this->action}();
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        }
    }

    public abstract function read();

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
}