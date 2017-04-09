<?php
namespace App\Controller;

use App\Core\Controller;

class Register extends Controller
{
    public function read()
    {
        if ($this->request->existParam('post', 'register')) {
            $datasForm = $this->request->getParams('post');
            $register = new \App\Model\Register();
            $register->setUser($datasForm);
            if ($register->isValid()) {
                $register->register();
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('registerForm', $register->getUser());
                $this->request->getSession()->setAttribut('registerErrors', $register->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /#register');
                exit();
            }
        }
        if ($this->request->existParam('get', 'token') && $this->request->existParam('get', 'id')) {
            $register = new \App\Model\Register();
            $id = $this->request->getParam('get', 'id');
            $token = $this->request->getParam('get', 'token');
            if ($register->isConfirmed($id, $token)) {
                $register->valideRegister();
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /#connexion');
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /');
                exit();
            }
        }
        header('Location: /');
        exit();
    }
}