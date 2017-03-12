<?php
namespace App\Controller;

use App\Model\Controller;

class Home extends Controller
{
    private $websiteConfig;
    private $book;

    public function __construct()
    {
        $this->websiteConfig = new \App\Model\WebsiteConfig();
        $this->book = new \App\Model\Book();
    }

    public function index($bookname)
    {
        $config = $this->websiteConfig->getConfig();
        $book = $this->book->getTheLastBook();
        $this->generateView(array(
            'config' => $config,
            'book' => $book
        ));
    }
}