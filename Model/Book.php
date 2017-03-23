<?php
namespace App\Model;

class Book extends \App\Core\Database
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
}