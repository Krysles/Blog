<?php
namespace App\Controller;

use App\Model\Ticket;

class Episode extends \App\Core\Controller
{
    protected $createmin = \App\Model\User::ADMIN;
    protected $createmax = \App\Model\User::ADMIN;
    protected $updatemin = \App\Model\User::ADMIN;
    protected $updatemax = \App\Model\User::ADMIN;
    protected $deletemin = \App\Model\User::ADMIN;
    protected $deletemax = \App\Model\User::ADMIN;
    protected $imagedeletemin = \App\Model\User::ADMIN;
    protected $imagedeletemax = \App\Model\User::ADMIN;

    public function read()
    {
        if ($this->request->existParam('get', 'id')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            if ($ticketManager->getTicket()->getTicket($number)) {
                $this->generateView(array(
                    'ticket' => $ticketManager->getTicket()->getTicket($number)
                ));
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        }
    }

    public function create()
    {
        if ($this->request->existParam('post', 'submitbtn')) {
            $datasForm = $this->request->getParams('post');
            $datasImage = $this->request->getParam('files', 'image');
            $ticketManager = new \App\Model\TicketManager();
            $ticketManager->setTicket($datasForm, $datasImage);
            if ($ticketManager->isValid()) {
                $ticketManager->insert();
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/'.$ticketManager->getTicket()->getNumber());
                exit();
            } else {
                $this->request->getSession()->setAttribut('ticketManagerForm', $ticketManager->getTicket());
                $this->request->getSession()->setAttribut('ticketManagerErrors', $ticketManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/create');
                exit();
            }
        }
        $this->generateView();
    }

    public function update()
    {
        if ($this->request->existParam('get', 'id') && $this->request->getSession()->notExistAttribut('ticketManagerForm')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            if ($ticketManager->getTicket()->getTicket($number)) {
                $ticketManager->setTicket($ticketManager->getTicket()->getTicket($number));
                $this->request->getSession()->setAttribut('ticketManagerForm', $ticketManager->getTicket());
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        }
        if ($this->request->existParam('post', 'submitbtn')) {
            $datasForm = $this->request->getParams('post');
            $datasImage = $this->request->getParam('files', 'image');
            $ticketManager = new \App\Model\TicketManager();
            $number = $this->request->getParam('get', 'id');
            $ticketManager->setTicket($ticketManager->getTicket()->getTicket($number));
            $this->request->getSession()->deleteAttribut('ticketManagerForm');
            $ticketManager->setTicket($datasForm, $datasImage);
            if ($ticketManager->isValid()) {
                $ticketManager->update();
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/'.$ticketManager->getTicket()->getNumber());
                exit();
            } else {
                $this->request->getSession()->setAttribut('ticketManagerForm', $ticketManager->getTicket());
                $this->request->getSession()->setAttribut('ticketManagerErrors', $ticketManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/'.$ticketManager->getTicket()->getNumber().'/update');
                exit();
            }
        }
        $this->generateView();
    }

    public function delete()
    {
        $this->generateView();
    }

    public function imagedelete()
    {
        if ($this->request->existParam('get', 'id')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            if ($ticketManager->getTicket()->getTicket($number)) {
                $ticketManager->setTicket($ticketManager->getTicket()->getTicket($number));
                $ticketManager->deleteimage();
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/'.$ticketManager->getTicket()->getNumber());
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        }
    }
}
