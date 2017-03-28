<?php
namespace App\Controller;

class Deconnexion extends \App\Core\Controller
{
    public function read()
    {
        $this->request->getSession()->deconnexion();
        $this->request->getSession()->setAttribut('flash', array('success' => 'Vous avez été déconnecté.'));
        header('Location: /');
        exit();
    }
}