<?php
namespace App\Model;

use \App\Core\Database;
use App\Validator\ValidateComment;

class CommentManager extends Database
{
    const LEVELMAX = 4;

    private $comments = array();
    private $nbComments = 0;
    private $comment;
    private $validator;
    private $message = array();

    public function __construct() { $this->comment = new \App\Model\Comment(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getComment() { return $this->comment; }

    public function setComment($comment) { $this->comment->hydrate($comment); }

    public function getComments() { return $this->comments; }

    public function setComments($comments) {
        $this->comments = $comments;
    }

    public function getNbComments($ticket_id) {
        $sql = "SELECT COUNT(ticket_id) nb FROM comment WHERE ticket_id = :ticket_id";
        return $this->runRequest($sql, array(
            ':ticket_id' => $ticket_id
        ))->fetch();
    }

    public function orderComments()
    {
        $comments_by_id = array();
        foreach ($this->comments as $k => $comment) {
            $this->nbComments = $this->nbComments + 1;
            $comments_by_id[$comment->id] = $comment;
            if ($comment->comment_id != 0) {
                $comments_by_id[$comment->comment_id]->children[] = $comment;
                unset($this->comments[$k]);
            }
        }
    }

    public function isValid()
    {
        $this->validator = new ValidateComment();
        
        $this->validator->validContent($this->comment->getContent());
        $this->validator->validLevel($this->comment->getLevel(), self::LEVELMAX);

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème à été rencontré lors de la validation.");
            return false;
        }
    }

    public function insert()
    {
        if ($this->getComment()->getComment_id() == 0 || empty($this->getComment()->getComment_id())) {
            $this->getComment()->setComment_id(NULL);
            $sql = "SELECT number ticket_number FROM ticket WHERE id = :id";
            $this->comment->hydrate($this->runRequest($sql, array(
                ':id' => $this->comment->getTicket_id()
            ))->fetch(\PDO::FETCH_ASSOC));
        } else {
            $sql = "SELECT c.level level, t.number ticket_number FROM comment c INNER JOIN ticket t ON c.ticket_id = t.id WHERE c.id = :id";
            $this->comment->hydrate($this->runRequest($sql, array(
                ':id' => $this->comment->getComment_id()
            ))->fetch(\PDO::FETCH_ASSOC));
        }
        $this->comment->setLevel($this->comment->getLevel() + 1);
        $sql = "INSERT INTO comment SET content = :content, date = NOW(), level = :level, ticket_id = :ticket_id, user_id = :user_id, comment_id = :comment_id";
        $this->runRequest($sql, array(
            ':content' => $this->comment->getContent(),
            ':level' => $this->comment->getLevel(),
            ':ticket_id' => $this->comment->getTicket_id(),
            ':user_id' => $this->comment->getUser_id(),
            ':comment_id' => $this->comment->getComment_id(),
        ));
        $this->setMessage('success', "Merci de votre commentaire.");
    }

    public function getCommentsFromBdd($ticketid)
    {
        $sql = "SELECT c.id, c.content, DATE_FORMAT(c.date, '%d-%m-%Y - %H:%i:%s') date, c.report, c.level, c.comment_id, u.firstname, u.lastname FROM comment c INNER JOIN user u ON c.user_id = u.id INNER JOIN ticket t ON c.ticket_id = t.id WHERE t.id = :ticketid ORDER BY c.id";
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
            $this->setMessage('danger', "Le commentaire n'est pas signalé.");
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
        $sql = "DELETE FROM comment WHERE id = :id";
        $this->runRequest($sql, array(
            ':id' => $this->comment->getId()
        ));
        $this->setMessage('success', "Le commentaire vient d'être supprimé.");
    }
}