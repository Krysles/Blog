<?php
namespace App\Model;

use \App\Core\Database;

class Book extends Database
{
    private function getBaseQuery()
    {
        return "SELECT b.title title, b.subtitle subtitle, b.summary summary, b.imgUrl url, u.firstname firstname, u.lastname lastname FROM book b INNER JOIN user u ON b.user_id = u.id ";
    }

    public function getTheLastBook()
    {
        $sql = $this->getBaseQuery() . 'ORDER BY b.id DESC';
        $theLastBook = $this->runRequest($sql)->fetch();
        return $theLastBook;
    }

    public function countTickets()
    {
        $sql = "SELECT count(*) AS nbTickets FROM ticket t INNER JOIN user u ON t.user_id = u.id INNER JOIN book b ON t.book_id = b.id WHERE b.id = 1 AND t.publish = 1";
        return $this->runRequest($sql)->fetch()->nbTickets;
    }

    public function getTickets($start, $nbEntriesPerPage)
    {
        $sql = "SELECT t.number number, t.title title, t.content content, t.publish publish, t.date date, t.imgUrl imgUrl, u.lastname lastname, u.firstname firstname FROM ticket t INNER JOIN user u ON t.user_id = u.id INNER JOIN book b ON t.book_id = b.id WHERE b.id = 1 AND t.publish = 1 ORDER BY t.number DESC LIMIT :start, :nbEntriesPerPage";
        $tickets = $this->runRequest($sql, array(
            ':start' => $start,
            ':nbEntriesPerPage' => $nbEntriesPerPage
        ))->fetchAll(\PDO::FETCH_ASSOC);
        return $tickets;
    }

    public function getTicketsNoPublish()
    {
        $sql = "SELECT t.number number, t.title title, t.content content, t.publish publish, t.date date, t.imgUrl imgUrl, u.lastname lastname, u.firstname firstname FROM ticket t INNER JOIN user u ON t.user_id = u.id INNER JOIN book b ON t.book_id = b.id WHERE b.id = 1 AND t.publish = 0 ORDER BY t.number DESC";
        $tickets = $this->runRequest($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $tickets;
    }

    public function getTicketNumbers()
    {
        $sql = "SELECT t.number number FROM ticket t INNER JOIN book b ON t.book_id = b.id";
        return $this->runRequest($sql)->fetchAll();
    }
}