<?php
namespace App\Core;

use \App\Core\Session;

class Request
{
    private $params = array();
    private $session;

    public function __construct($get, $post, $files)
    {
        $this->params['get'] = $this->clean($get);
        $this->params['post'] = $this->clean($post);
        $this->params['files'] = $files;
        $this->session = new Session();
    }

    public function getSession()
    {
        return $this->session;
    }

    public function existParam($method, $name)
    {
        if (isset($this->params[$method][$name]) && $this->params[$method][$name] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function existParams($method)
    {
        if (isset($this->params[$method]) && $this->params[$method] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function getParam($method, $name)
    {
        if ($this->existParam($method, $name)) {
            return $this->params[$method][$name];
        } else {
            throw new \Exception("Le paramètre $name de la méthode $method n'exist pas.");
        }
    }

    public function getParams($method)
    {
        if ($this->existParams($method)) {
            return $this->params[$method];
        } else {
            throw new \Exception("La méthode $method n'exist pas.");
        }
    }

    public function deleteParam($method, $name)
    {
        if ($this->existParam($method, $name)) {
            unset($this->param[$method][$name]);
        } else {
            throw new \Exception("Le paramètre $name de la méthode $method n'exist pas.");
        }
    }

    public function deleteParams($method)
    {
        if ($this->existParams($method)) {
            unset($this->params[$method]);
        } else {
            throw new \Exception("La méthode $method n'exist pas.");
        }
    }
    
    public function clean($values)
    {
        $cleanValues = array();
        foreach ($values as $param => $value) {
            $cleanValues[$param] = htmlspecialchars($value);
        }
        return $cleanValues;
    }
}