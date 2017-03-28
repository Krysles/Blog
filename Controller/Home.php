<?php
namespace App\Controller;

use App\Core\Controller;
use App\Model\Book;
use App\Core\WebsiteConfig;

class Home extends Controller
{
    private $websiteConfig;
    private $book;
    
    public function read()
    {
        $this->websiteConfig = new WebsiteConfig();
        $this->book = new Book();
        $config = $this->websiteConfig->getConfig();
        $book = $this->book->getTheLastBook();
        $this->generateView(array(
            'config' => $config,
            'book' => $book
        ));
    }
}