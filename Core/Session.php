<?php
namespace App\Core;

use App\Model\User;

class Session
{
    public function __construct()
    {
        session_start();
        if ($this->notExistAttribut('auth')) {
            $user = new User();
            $user->setRole(User::VISITOR);
            $this->setAttribut('auth', $user);
        }
    }

    public function deconnexion()
    {
        unset($_SESSION['auth']);
    }

    public function setAttribut($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function existAttribut($name)
    {
        return (isset($_SESSION[$name]) && $_SESSION[$name] != "");
    }

    public function notExistAttribut($name)
    {
        return (!isset($_SESSION[$name]));
    }

    public function getAttribut($name)
    {
        if ($this->existAttribut($name)) {
            return $_SESSION[$name];
        } else {
            throw new \Exception("Attribut absent.");
        }
    }

    public function deleteAttribut($name)
    {
        if ($this->existAttribut($name)) {
            unset($_SESSION[$name]);
        } else {
            throw new \Exception("Attribut absent.");
        }
    }
}