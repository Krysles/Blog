<?php
namespace App\Model;

class Request
{
    private $params = array();

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function existParams($name)
    {
        if (isset($this->params[$name]) && $this->params[$name] != "") {
            return true;
        } else {
            return false;
        }
    }

    public function getParams($name)
    {
        if ($this->existParams($name)) {
            return $this->params[$name];
        } else {
            throw new \Exception("Le paramètre $name n'exist pas.");
        }
    }
}