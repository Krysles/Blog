<?php
namespace App\Controller;

use App\Core\Controller;
use App\Model\Lostpassword;
use App\Model\User;

class Recovery extends Controller
{
    protected $readmin = User::VISITOR;
    protected $readmax = User::VISITOR;
    protected $updatemin = User::VISITOR;
    protected $updatemax = User::VISITOR;

    public function read()
    {
        if ($this->request->getSession()->getAttribut('auth')->getRole() >= \App\Model\User::MEMBER) {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        }
        if ($this->request->existParam('post', 'lostpassword')) {
            $datasForm = $this->request->getParams('post');
            $lostpassword = new Lostpassword();
            $lostpassword->setUser($datasForm);
            if ($lostpassword->isValid()) {
                $lostpassword->lostpassword();
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('lostpasswordForm', $lostpassword->getUser());
                $this->request->getSession()->setAttribut('lostpasswordErrors', $lostpassword->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /recovery/#lostpassword');
                exit();
            }
        }
        if ($this->request->existParam('get', 'token') && $this->request->existParam('get', 'id')) {
            $lostpassword = new Lostpassword();
            $id = $this->request->getParam('get', 'id');
            $token = $this->request->getParam('get', 'token');
            if ($lostpassword->isConfirmed($id, $token)) {
                $this->request->getSession()->setAttribut('recovery', $lostpassword->getLostpassword());
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /recovery/update');
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /');
                exit();
            }
        }
        $this->generateView();
    }
    
    public function update()
    {
        if ($this->request->getSession()->existAttribut('recovery'))
        {
            if ($this->request->existParam('post', 'recovery')) {
                $datasForm = $this->request->getParams('post');
                $recovery = new \App\Model\Recovery();
                $recovery->setUser($datasForm);
                if ($recovery->isValid()) {
                    $date = new \DateTime();
                    $recovery->setUser($this->request->getSession()->getAttribut('recovery'));
                    $this->request->getSession()->deleteAttribut('recovery');
                    $recovery->getUser()->setResetDate($date->format('Y-m-d H:i:s'));
                    $recovery->recovery();
                    $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                    header('Location: /');
                    exit();
                } else {
                    $this->request->getSession()->setAttribut('recoveryErrors', $recovery->getValidator()->getErrors());
                    $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                    header('Location: /recovery/update#recovery');
                    exit();
                }
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        }
        $this->generateView();
    }
}