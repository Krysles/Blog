<?php
namespace App\Model;

use App\Core\Database;

class Page extends Database {

    const ENTRIESPERPAGE = 5;

    private $page;
    private $book;
    private $entries;
    private $title;
    private $nbPages;
    private $message = array();
    
    public function __construct()
    {
        $this->book = new \App\Model\Book();
        $this->entries = $this->book->countTickets();
        $this->title = $this->book->getTheLastBook()->title;
        $this->nbPages = ceil($this->entries / self::ENTRIESPERPAGE);
    }

    public function getPage() { return $this->page; }

    public function setPage($page) { $this->page = $page; }

    public function getBook() { return $this->book; }

    public function setBook($book) { $this->book = $book; }

    public function getEntries() { return $this->entries; }

    public function setEntries($entries) { $this->entries = $entries; }

    public function getTitle() { return $this->title; }

    public function setTitle($title) { $this->title = $title; }
    
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

    public function getTickets()
    {
        $start = ($this->getPage() * self::ENTRIESPERPAGE - self::ENTRIESPERPAGE);
        return $this->book->getTickets($start, self::ENTRIESPERPAGE);
    }
}