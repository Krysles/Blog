<?php
namespace App\Controller;

use App\Core\Session;
use App\Model\User;

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
            $ticketManager = new \App\Model\TicketManager();
            $ticket = $ticketManager->getTicketFromBdd($this->request->getParam('get', 'id'));
            if ($ticket) {
                $ticketManager->setTicket($ticket);
                if (($ticketManager->getTicket()->getPublish() == 0) && (Session::getSession()->getRole() < User::ADMIN)) {
                    $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                    header('Location: /page');
                    exit();
                } else {
                    $commentManager = new \App\Model\CommentManager();
                    $commentManager->setComments($commentManager->getCommentsFromBdd($ticketManager->getTicket()->getId()));
                    $commentManager->orderComments();
                    $this->generateView(array(
                        'adjacentTickets' => $ticketManager->getAdjacentTickets($this->request->getParam('get', 'id')),
                        'ticket' => $ticket,
                        'comments' => $commentManager->getComments(),
                        'nbComments' => $commentManager->getNbComments($ticketManager->getTicket()->getId())
                    ));
                }
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
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
                header('Location: /episode/' . $ticketManager->getTicket()->getNumber());
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
            if ($ticketManager->getTicketFromBdd($number)) {
                $ticketManager->setTicket($ticketManager->getTicketFromBdd($number));
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
            $ticketManager->setTicket($ticketManager->getTicketFromBdd($number));
            $this->request->getSession()->deleteAttribut('ticketManagerForm');
            $ticketManager->setTicket($datasForm, $datasImage);
            if ($ticketManager->isValid()) {
                $ticketManager->update();
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/' . $ticketManager->getTicket()->getNumber());
                exit();
            } else {
                $this->request->getSession()->setAttribut('ticketManagerForm', $ticketManager->getTicket());
                $this->request->getSession()->setAttribut('ticketManagerErrors', $ticketManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/' . $ticketManager->getTicket()->getNumber() . '/update');
                exit();
            }
        }
        $this->generateView();
    }

    public function delete()
    {
        if ($this->request->existParam('post', 'submitbtn')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            $ticket = $ticketManager->getTicketFromBdd($number);
            $ticketManager = new \App\Model\TicketManager();
            $ticketManager->setTicket($ticket);
            $ticketManager->delete();
            $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
            header('Location: /page');
            exit();
        } elseif ($this->request->existParam('get', 'id')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            $ticket = $ticketManager->getTicketFromBdd($number);
            if ($ticket) {
                $ticketManager->setTicket($ticket);
                $ticket = $ticketManager->getTicket();
                $this->generateView(array(
                    'ticket' => $ticket
                ));
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        }
    }

    public function imagedelete()
    {
        if ($this->request->existParam('get', 'id')) {
            $number = $this->request->getParam('get', 'id');
            $ticketManager = new \App\Model\TicketManager();
            if ($ticketManager->getTicketFromBdd($number)) {
                $ticketManager->setTicket($ticketManager->getTicketFromBdd($number));
                $ticketManager->deleteimage();
                $this->request->getSession()->setAttribut('flash', $ticketManager->getMessage());
                header('Location: /episode/' . $ticketManager->getTicket()->getNumber());
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
                header('Location: /page');
                exit();
            }
        }
    }
}
