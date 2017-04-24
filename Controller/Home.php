<?php
namespace App\Controller;

use App\Core\Controller;
use App\Model\Book;
use App\Core\WebsiteConfig;

class Home extends Controller
{
    public function read()
    {
        $configurationManager = new \App\Model\ConfigurationManager();
        $configurationManager->setConfiguration($configurationManager->getConfig());

        $bookManager = new \App\Model\BookManager();
        $bookManager->setBook($bookManager->getTheLastBook());


        $this->generateView(array(
            'configuration' => $configurationManager->getConfiguration(),
            'book' => $bookManager->getBook()
        ));
    }
}