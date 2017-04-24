<?php
namespace App\Controller;

class Book extends \App\Core\Controller
{
    protected $readmin = \App\Model\User::ADMIN;
    protected $readmax = \App\Model\User::ADMIN;
    protected $updatemin = \App\Model\User::ADMIN;
    protected $updatemax = \App\Model\User::ADMIN;
    protected $imagedeletemin = \App\Model\User::ADMIN;
    protected $imagedeletemax = \App\Model\User::ADMIN;

    public function read()
    {
        $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
        header('Location: /');
        exit();
    }
    public function update()
    {
        if ($this->request->existParam('post', 'book')) {
            $datasForm = $this->request->getParams('post');
            $datasImage = $this->request->getParam('files', 'image');
            $bookManager = new \App\Model\BookManager();
            $bookManager->setBook($bookManager->getTheLastBook());
            $bookManager->setBook($datasForm, $datasImage);
            if ($bookManager->isValid()) {
                $bookManager->update();
                $this->request->getSession()->setAttribut('flash', $bookManager->getMessage());
                header('Location: /admin');
                exit();
            } else {
                $this->request->getSession()->setAttribut('bookForm', $bookManager->getBook());
                $this->request->getSession()->setAttribut('bookErrors', $bookManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $bookManager->getMessage());
                header('Location: /admin');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /');
            exit();
        }
    }

    public function imagedelete()
    {
        $bookManager = new \App\Model\BookManager();
        if ($bookManager->getTheLastBook()) {
            $bookManager->setBook($bookManager->getTheLastBook());
            $bookManager->deleteimage();
            $this->request->getSession()->setAttribut('flash', $bookManager->getMessage());
            header('Location: /admin');
            exit();
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /');
            exit();
        }
    }
}





