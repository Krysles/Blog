<?php
namespace App\Model;

use App\Core\Database;
use App\Core\Session;

class TicketManager extends Database
{
    private $ticket;
    private $imageManager;
    private $validator;
    private $message = array();

    public function __construct()
    {
        $this->ticket = new \App\Model\Ticket();
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket($ticket, $image = array())
    {
        $this->ticket->hydrate($ticket);
        $this->imageManager = new \App\Model\ImageManager();
        $this->imageManager->setImage($image);
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($alert, $error)
    {
        $this->message[$alert] = $error;
    }

    public function isValid()
    {
        $this->validator = new \App\Validator\ValidateTicket();
        $this->validator->validTitle($this->ticket->getTitle());
        $this->validator->validContent($this->ticket->getContent());
        $this->validator->validImage($this->imageManager->getImage());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la création de l'épisode.");
            return false;
        }
    }

    public function insert()
    {
        if ($this->imageManager->getImage()->getError() === 0) {
            $this->ticket->setId($this->getNextId()['Auto_increment']);
            $this->imageManager->process($this->getTicket());
        }
        $this->ticket->setNumber($this->ticket->getLast('ticket', 'number')->number + 1);

        $sql = "INSERT INTO ticket SET number = :number, title = :title, content = :content, imgUrl = :imgUrl, publish = :publish, date = NOW(), book_id = :bookId, user_id = :userId";
        $this->runRequest($sql, array(
            ':number' => $this->ticket->getNumber(),
            ':title' => $this->ticket->getTitle(),
            ':content' => $this->ticket->getContent(),
            ':imgUrl' => $this->ticket->getImgUrl(),
            ':publish' => $this->ticket->getPublish(),
            ':bookId' => 1,
            ':userId' => Session::getSession()->getId()
        ));

        $this->setMessage('success', "L'épisode a bien été créé.");
    }

    public function update()
    {
        if ($this->imageManager->getImage()->getError() === 0) {
            Services::deleteFile(substr($this->getTicket()->getImgUrl(), 1));
            $this->imageManager->process($this->getTicket());
        }

        $sql = "UPDATE ticket SET number = :number, title = :title, content = :content, imgUrl = :imgUrl, publish = :publish, date = NOW(), book_id = :bookId, user_id = :userId WHERE id = :id";
        $this->runRequest($sql, array(
            ':number' => $this->ticket->getNumber(),
            ':title' => $this->ticket->getTitle(),
            ':content' => $this->ticket->getContent(),
            ':imgUrl' => $this->ticket->getImgUrl(),
            ':publish' => $this->ticket->getPublish(),
            ':bookId' => 1,
            ':userId' => Session::getSession()->getId(),
            'id' => $this->ticket->getId()
        ));

        $this->setMessage('success', "L'épisode a bien été mis à jour.");
    }

    public function deleteimage()
    {
        Services::deleteFile(substr($this->getTicket()->getImgUrl(), 1));
        $this->ticket->setImgUrl(null);
        $this->update();

        $this->setMessage('success', "L'image a bien été supprimé.");
    }

    public function getNextId()
    {
        $sql = "SHOW TABLE STATUS FROM jeanforteroche LIKE 'ticket'";
        return $this->runRequest($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        $sql = "DELETE FROM ticket WHERE number = :number";

        $this->runRequest($sql, array(
            ':number' => $this->getTicket()->getNumber()
        ));
        if (!$this->getTicket()->getTicket($this->getTicket()->getNumber())) {
            Services::deleteFile(substr($this->getTicket()->getImgUrl(), 1));
            $sql = "UPDATE ticket SET number = number - 1 WHERE number > :number";
            $this->runRequest($sql, array(
                ':number' => $this->getTicket()->getNumber()
            ));
            $this->setMessage('success', "L'épisode a bien été supprimé.");
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la suppression de l'épisode.");
            return false;
        }
    }
}