<?php
namespace App\Model;

use App\Core\Database;

class Page extends Database {

    const ENTRIESPERPAGE = 5;

    private $page;
    private $bookManager;
    private $ticketManager;
    private $entries;
    private $nbPages;
    private $message = array();
    
    public function __construct()
    {
        $this->bookManager = new \App\Model\BookManager();
        $this->bookManager->setBook($this->bookManager->getTheLastBook());
        $this->ticketManager = new \App\Model\TicketManager();
        $this->entries = $this->ticketManager->count('ticket', 'id', array('publish' => 1)); //
        $this->nbPages = ceil($this->entries / self::ENTRIESPERPAGE);
    }

    public function getPage() { return $this->page; }

    public function setPage($page) { $this->page = $page; }

    public function getBookManager() { return $this->bookManager; }

    public function setBookManager($bookManager) { $this->bookManager = $bookManager; }

    public function getTicketManager() { return $this->ticketManager; }

    public function setTicketManager($ticketManager) { $this->ticketManager = $ticketManager; }

    public function getEntries() { return $this->entries; }

    public function setEntries($entries) { $this->entries = $entries; }
    
    public function getNbPages() { return $this->nbPages; }
    
    public function setNbPages($nbPages) { $this->nbPages = $nbPages; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }
    
    public function isValid($page)
    {
        if ($page >= 1 && $page <= $this->getNbPages()) {
            $this->setPage($page);
            return true;
        } else {
            $this->setMessage('danger', "La page demandée n'existe pas.");
            return false;
        }
    }

    public function getTicketsFromPage()
    {
        $start = ($this->getPage() * self::ENTRIESPERPAGE - self::ENTRIESPERPAGE);
        return $this->ticketManager->getTickets($start, self::ENTRIESPERPAGE);
    }
}