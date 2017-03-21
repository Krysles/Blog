<?php
namespace App\Model;

class Session
{
    public function __construct() { session_start(); }
    
    public function deconnexion() {
        unset($_SESSION['auth']);
    }
    
    public function setAttribut($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    public function existAttribut($name)
    {
        return (isset($_SESSION[$name]) && $_SESSION[$name] != "");
    }
    
    public function getAttribut($name)
    {
        if ($this->existAttribut($name)) {
            return $_SESSION[$name];
        } else {
            throw new \Exception("Attribut absent.");
        }
    }
}