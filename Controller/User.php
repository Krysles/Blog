<?php
namespace App\Controller;

use App\Core\Session;

class User extends \App\Core\Controller
{
    protected $readmin = \App\Model\User::ADMIN;
    protected $readmax = \App\Model\User::ADMIN;
    protected $bannedmin = \App\Model\User::ADMIN;
    protected $bannedmax = \App\Model\User::ADMIN;
    protected $approvemin = \App\Model\User::ADMIN;
    protected $approvemax = \App\Model\User::ADMIN;

    public function read()
    {
        $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
        header('Location: /');
        exit();
    }

    public function banned()
    {
        if ($this->request->existParam('post', 'banned')) {
            $datasForm = $this->request->getParams('post');
            $user = new \App\Model\User();
            $user->hydrate($datasForm);
            if ($user->checkUser(array('id' => $user->getId()))) {
                if (Session::getSession()->getId() != $user->getId()) {
                    $user->updateUser(array(
                        'role' => \App\Model\User::BANNED
                    ), $user->getId());
                    $this->request->getSession()->setAttribut('flash', array('success' => "Le membre a bien été banni."));
                    header('Location: /admin');
                    exit();
                } else {
                    $this->request->getSession()->setAttribut('flash', array('danger' => "Vous ne pouvez pas vous bannir."));
                    header('Location: /admin');
                    exit();
                }
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Aucun membre trouvé."));
                header('Location: /');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /');
            exit();
        }
    }

    public function approve()
    {
        if ($this->request->existParam('get', 'id')) {
            $datasForm = $this->request->getParams('get');
            $user = new \App\Model\User();
            $user->hydrate($datasForm);
            if ($user->checkUser(array('id' => $user->getId()))) {
                $user->updateUser(array(
                    'role' => \App\Model\User::MEMBER
                ), $user->getId());
                $this->request->getSession()->setAttribut('flash', array('success' => "Le membre a bien été approuvé."));
                header('Location: /admin');
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Aucun membre trouvé."));
                header('Location: /');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
        }
    }
}