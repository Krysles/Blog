<?php
namespace App\Model;

use \App\Core\Database;
use App\Validator\ValidateComment;

class CommentManager extends Database
{
    private $comment;
    private $validator;
    private $message = array();

    public function __construct() { $this->comment = new \App\Model\Comment(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getComment() { return $this->comment; }

    public function setComment($comment) { $this->comment->hydrate($comment); }

    public function isValid()
    {
        $this->validator = new ValidateComment();
        
        $this->validator->validContent($this->comment->getContent());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème à été rencontré lors de la validation.");
            return false;
        }
    }

    public function insert()
    {
        $sql = "INSERT INTO comment SET content = :content, date = NOW(), level = 0, ticket_id = :ticket_id, user_id = :user_id, comment_id = :comment_id";
        $this->runRequest($sql, array(
            ':content' => $this->comment->getContent(),
            ':ticket_id' => $this->comment->getTicket_id(),
            ':user_id' => $this->comment->getUser_id(),
            ':comment_id' => $this->comment->getComment_id(),
        ));
        $this->setMessage('success', "Merci de votre commentaire.");
    }

    public function getComments($ticketid)
    {
        $sql = "SELECT c.id, c.content, c.date, c.report, c.level, c.comment_id, u.firstname, u.lastname
                FROM comment c
                INNER JOIN user u
                ON c.user_id = u.id
                INNER JOIN ticket t
                ON c.ticket_id = t.id
                WHERE t.number = :ticketid
                ORDER BY c.id";
        return $this->runRequest($sql, array(
            ':ticketid' => $ticketid
        ))->fetchAll();
    }
    
    public function getCommentFromBdd($id)
    {
        $sql = "SELECT c.id, c.report, c.ticket_id, t.id as ticket_id, t.number as ticket_number
                FROM comment c
                INNER JOIN ticket t
                ON c.ticket_id = t.id
                WHERE c.id = :id";
        return $this->runRequest($sql, array(
            ':id' => $id
        ))->fetch(\PDO::FETCH_ASSOC);
    }

    public function report()
    {
        $this->comment->setReport(1);
        $sql = "UPDATE comment SET report = :report WHERE id = :id";
        $this->runRequest($sql, array(
            ':report' => $this->comment->getReport(),
            ':id' => $this->comment->getId()
        ));
        $message = new Message();
        $message->sendReport();
        $this->setMessage('success', "Le commentaire vient d'être signalé.");
    }

    public function getListCommentsReport()
    {
        $sql = "SELECT c.id as id, c.content as content, u.firstname as firstname, u.lastname as lastname, t.number as number, t.title as title
                FROM comment c
                INNER JOIN ticket t
                ON c.ticket_id = t.id
                INNER JOIN user u
                ON c.user_id = u.id
                WHERE c.report = 1
                ORDER BY c.id DESC";
        return $this->runRequest($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function isReport()
    {
        $this->validator = new ValidateComment();

        $this->validator->validReport($this->comment->getReport());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de l'approbation du commentaire.");
            return false;
        }
    }

    public function approve()
    {
        $this->comment->setReport(0);
        $sql = "UPDATE comment SET report = :report WHERE id = :id";
        $this->runRequest($sql, array(
            ':report' => $this->comment->getReport(),
            ':id' => $this->comment->getId()
        ));
        $this->setMessage('success', "Le commentaire vient d'être approuvé.");
    }

    public function delete() {
        $sql = "DELETE FROM comment WHERE id = :id OR comment_id = :id";
        $this->runRequest($sql, array(
            ':id' => $this->comment->getId()
        ));
    }
}