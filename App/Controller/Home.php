<?php
namespace App\Controller;

use App\Model\Controller;

class Home extends Controller
{
    private $home;
    
    public function __construct()
    {
        $this->home = new \App\Model\Home();
    }

    public function index()
    {
        $home = $this->home->getHome();
        $book = $this->home->getBook(1);
        $this->generateView(array(
            'home' => $home,
            'book' => $book
        ));
    }
}