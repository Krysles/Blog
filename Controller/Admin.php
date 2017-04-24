<?php
namespace App\Controller;

use App\Model\User;

class Admin extends \App\Core\Controller
{
    protected $readmin = \App\Model\User::MEMBER;
    protected $readmax = \App\Model\User::ADMIN;

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

        $this->generateView(array(
            'statistics' => $statistics,
            'ticketsNoPublish' => $ticketManager->getTicketsNoPublish(),
            'listCommentsReport' => $commentManager->getListCommentsReport(),
            'users' => $users->getUsersMinRole(User::MEMBER),
            'usersBanned' => $users->getUsersMaxRole(User::BANNED)
        ));
    }
}
