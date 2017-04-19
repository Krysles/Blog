<?php
namespace App\Model;

use App\Core\Database;

class Comment extends Database
{
    private $id;
    private $content;
    private $date;
    private $report;
    private $level = 0;
    private $ticket_id;
    private $ticket_number;
    private $user_id;
    private $comment_id = 0;


    public function __construct() {

    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }
    
    public function getTicket_number() { return $this->ticket_number; }

    public function setTicket_number($ticket_number) { $this->ticket_number = $ticket_number; }

    public function getContent() { return $this->content; }

    public function setContent($content) { $this->content = $content; }

    public function getDate() { return $this->date; }

    public function setDate($date) { $this->date = $date; }

    public function getReport() { return $this->report; }

    public function setReport($report) { $this->report = $report; }

    public function getLevel() { return $this->level; }

    public function setLevel($level) { $this->level = $level; }

    public function getTicket_id() { return $this->ticket_id; }

    public function setTicket_id($ticket_id) { $this->ticket_id = $ticket_id; }

    public function getUser_id() { return $this->user_id; }

    public function setUser_id($user_id) { $this->user_id = $user_id; }

    public function getComment_id() { return $this->comment_id; }

    public function setComment_id($comment_id) { $this->comment_id = $comment_id; }
}