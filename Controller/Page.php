<?php
namespace App\Controller;

use \App\Core\Controller;
use App\Model\User;

class Page extends Controller
{
    protected $updatemin = User::ADMIN;
    protected $updatemax = User::ADMIN;
    protected $deletemin = User::ADMIN;
    protected $deletemax = User::ADMIN;

    public function read()
    {

        $book = new \App\Model\Book();
        /*echo '<pre>';
        print_r($book->getTickets());
        echo '</pre>';
        die();*/
        $this->generateView(array(
            'tickets' => $book->getTickets(),
            'nbPage' => '4'
        ));
    }

    public function update()
    {
        die('je suis update en member');
        /*
        $book = new \App\Model\Book();
        $this->generateView(array(
            'book' => $book->getTheLastBook()
        ));*/
    }

    public function delete()
    {
        die('je suis delete en admin');
        /*
        $book = new \App\Model\Book();
        $this->generateView(array(
            'book' => $book->getTheLastBook()
        ));*/
    }
}