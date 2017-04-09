<?php
namespace App\Controller;

class Episode extends \App\Core\Controller
{
    protected $updatemin = \App\Model\User::VISITOR;
    protected $updatemax = \App\Model\User::ADMIN;
    protected $createmin = \App\Model\User::ADMIN;
    protected $createmax = \App\Model\User::ADMIN;
    protected $deletemin = \App\Model\User::VISITOR;
    protected $deletemax = \App\Model\User::ADMIN;

    public function read()
    {
        $ticket = new \App\Model\Ticket();
        if ($this->request->existParam('get', 'id')) {

            // le paramètre id existe on recupère le ticket correspondant
            $book = new \App\Model\Book();
            $ticket = $book->getTicket($this->request->getParam('get', 'id'));
            
        } else {
            // pas de paramètre direction la page d'accueil du site
        }

        $this->generateView(array(
            'ticket' => $ticket
        ));
    }

    public function update()
    {
        $ticket = new \App\Model\Ticket();
        if ($this->request->existParam('get', 'id')) {

            // le paramètre id existe on recupère le ticket correspondant
            $book = new \App\Model\Book();
            $ticket = $book->getTicket($this->request->getParam('get', 'id'));

        } else {
            // pas de paramètre direction la page d'accueil du site
        }

        $this->generateView(array(
            'ticket' => $ticket
        ));
    }

    public function create()
    {
        if ($this->request->existParam('post', 'submitbtn')) {
            $datasForm = $this->request->getParams('post');
            $datasImage = $this->request->getParam('files', 'image');
            $ticketManager = new \App\Model\TicketManager();
            $ticketManager->setTicket($datasForm, $datasImage);
            if ($ticketManager->isValid()) {
                $ticketManager->insert($this->request->getSession()->getAttribut('auth'));
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

    public function delete()
    {
        $this->generateView();
    }

}