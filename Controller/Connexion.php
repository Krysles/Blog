<?php
namespace App\Controller;

class Connexion extends \App\Core\Controller
{
    public function read()
    {
        if ($this->request->existParam('post', 'connexion')) {
            $datasForm = $this->request->getParams('post');
            $connexion = new \App\Model\Connexion();
            $connexion->setUser($datasForm);
            if ($connexion->isValid()) {
                if ($connexion->connexion()) {
                    $this->request->getSession()->setAttribut('auth', $connexion->getUser());
                    $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                    header('Location: /page');
                    exit();
                }
                $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                header('Location: /#connexion');
                exit();
            } else {
                $this->request->getSession()->setAttribut('connexionErrors', $connexion->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                header('Location: /#connexion');
                exit();
            }
        }
        header('Location: /');
        exit();
    }
}