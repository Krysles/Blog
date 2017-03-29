<?php
namespace App\Model;

use \App\Core\Database;

class Book extends Database
{
    private function getBaseQuery()
    {
        return "SELECT b.title title, b.subtitle subtitle, b.summary summary, b.img_url url, u.firstname firstname, u.lastname lastname FROM book b INNER JOIN user u ON b.user_id = u.id ";
    }

    public function getBook($id)
    {
        $sql = $this->getBaseQuery() . 'WHERE b.id = ?';
        $book = $this->runRequest($sql, array($id))->fetch();
        return $book;
    }

    public function getTheLastBook()
    {
        $sql = $this->getBaseQuery() . 'ORDER BY b.id DESC';
        $theLastBook = $this->runRequest($sql)->fetch();
        return $theLastBook;
    }
    
    public function getTickets()
    {
        $sql = "SELECT t.number number, t.title title, t.content content, t.publish publish, t.date date, t.img_url url, u.lastname lastname, u.firstname firstname FROM ticket t INNER JOIN user u ON t.user_id = u.id INNER JOIN book b ON t.book_id = b.id WHERE b.id = 1 AND t.publish = 1 ORDER BY t.number DESC";
        $tickets = $this->runRequest($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $tickets;
    }
}