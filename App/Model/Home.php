<?php
namespace App\Model;

class Home extends Database
{
    public function getHome()
    {
        $sql = 'SELECT * FROM home WHERE id = 1';
        $home = $this->runRequest($sql)->fetch();
        return $home;
    }

    public function getBook($id)
    {
        $sql = 'SELECT b.title book_title, b.subtitle book_subtitle, b.summary book_summary, b.img_url book_url, u.firstname book_firstname, u.lastname book_lastname FROM book b INNER JOIN user u ON b.user_id = u.id WHERE b.id = ?';
        $book = $this->runRequest($sql, array($id))->fetch();
        return $book;
    }
}