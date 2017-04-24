<?php
namespace App\Model;

use \App\Core\Database;

class BookManager extends Database
{
    private $book;
    private $imageManager;
    private $validator;
    private $message = array();

    public function __construct() { $this->book = new \App\Model\Book(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getBook() { return $this->book; }

    public function setBook($book, $image = array())
    {
        $this->book->hydrate($book);
        $this->imageManager = new \App\Model\ImageManager();
        $this->imageManager->setImage($image);
    }

    public function isValid()
    {
        $this->validator = new \App\Validator\ValidateBook();
        $this->validator->validTitle($this->book->getTitle());
        $this->validator->validSubtitle($this->book->getSubtitle());
        $this->validator->validSummary($this->book->getSummary());
        $this->validator->validImage($this->imageManager->getImage());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la modification du livre.");
            return false;
        }
    }
    
    public function getTheLastBook()
    {
        $sql = "SELECT b.id id, b.title title, b.subtitle subtitle, b.summary summary, b.imgUrl imgUrl, u.firstname firstname, u.lastname lastname
                FROM book b
                INNER JOIN user u
                ON b.user_id = u.id
                ORDER BY b.id DESC";
        return $this->runRequest($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteimage()
    {
        Services::deleteFile(substr($this->getBook()->getImgUrl(), 1));
        $this->book->setImgUrl(null);
        $this->update();

        $this->setMessage('success', "L'image a bien été supprimé.");
    }

    public function update()
    {
        if ($this->imageManager->getImage()->getError() === 0) {
            Services::deleteFile(substr($this->getBook()->getImgUrl(), 1));
            $this->imageManager->process($this->getBook(), 0);
        }

        $sql = "UPDATE book SET title = :title, subtitle = :subtitle, summary = :summary, imgUrl = :imgUrl, user_id = :userId WHERE id = :id";
        $this->runRequest($sql, array(
            ':title' => $this->book->getTitle(),
            ':subtitle' => $this->book->getSubtitle(),
            ':summary' => $this->book->getSummary(),
            ':imgUrl' => $this->book->getImgUrl(),
            ':userId' => \App\Core\Session::getSession()->getId(),
            ':id' => 1
        ));

        $this->setMessage('success', "Le livre a bien été mis à jour.");
    }
}