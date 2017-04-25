<?php
namespace App\Controller;

use App\Model\User;

class Admin extends \App\Core\Controller
{
    protected $readmin = \App\Model\User::MEMBER;
    protected $readmax = \App\Model\User::ADMIN;
    protected $resetmin = \App\Model\User::MEMBER;
    protected $resetmax = \App\Model\User::ADMIN;

    public function read()
    {
        $statistics = new \App\Model\Statistics();
        $ticketManager = new \App\Model\TicketManager();
        $commentManager = new \App\Model\CommentManager();
        $users = new \App\Model\User();

        if ($this->request->getSession()->notExistAttribut('bookForm')) {
            $bookManager = new \App\Model\BookManager();
            $bookManager->setBook($bookManager->getTheLastBook());
            $this->request->getSession()->setAttribut('bookForm', $bookManager->getBook());
        }

        if ($this->request->getSession()->notExistAttribut('configurationForm')) {
            $configurationManager = new \App\Model\ConfigurationManager();
            $configurationManager->setConfiguration($configurationManager->getConfig());
            $this->request->getSession()->setAttribut('configurationForm', $configurationManager->getConfiguration());
        }

        if ($this->request->getSession()->existAttribut('auth') && !empty($this->request->getSession()->getAttribut('auth')->getId())) {
            $userInformations = new \App\Model\User();
            $userInformations->hydrate($userInformations->checkUser(array('id' => $this->request->getSession()->getAttribut('auth')->getId())));
            $userInformations->setPassword(NULL);
        }

        $this->generateView(array(
            'statistics' => $statistics,
            'ticketsNoPublish' => $ticketManager->getTicketsNoPublish(),
            'listCommentsReport' => $commentManager->getListCommentsReport(),
            'users' => $users->getUsersMinRole(User::MEMBER),
            'usersBanned' => $users->getUsersMaxRole(User::BANNED),
            'userInformations' => $userInformations
        ));
    }

    public function reset()
    {
        if ($this->request->existParam('post', 'reset')) {
            $datasForm = $this->request->getParams('post');
            $recovery = new \App\Model\Recovery();
            $recovery->setUser($datasForm);
            if ($recovery->isValid()) {
                $date = new \DateTime();
                $recovery->getUser()->setId($this->request->getSession()->getAttribut('auth')->getId());
                $recovery->getUser()->setEmail($this->request->getSession()->getAttribut('auth')->getEmail());
                $recovery->getUser()->setResetDate($date->format('Y-m-d H:i:s'));
                $recovery->recovery();
                $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                header('Location: /admin');
                exit();
            } else {
                $this->request->getSession()->setAttribut('resetErrors', $recovery->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                header('Location: /admin');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        }
    }
}
