<?php
namespace App\Model;

use \App\Core\Database;
use App\Core\Session;

class Statistics extends Database
{
    private $nbComments;
    private $nbCommentsUser;
    private $nbTicketsPublish;
    private $nbUsers;

    public function getNbComments() { return $this->nbComments; }
    public function getNbCommentsUser() { return $this->nbCommentsUser; }
    public function getNbTicketsPublish() { return $this->nbTicketsPublish; }
    public function getNbUsers() { return $this->nbUsers; }

    public function setNbComments($nbComments) { $this->nbComments = $nbComments; }
    public function setNbCommentsUser($nbCommentsUser) { $this->nbCommentsUser = $nbCommentsUser; }
    public function setNbTicketsPublish($nbTicketsPublish) { $this->nbTicketsPublish = $nbTicketsPublish; }
    public function setNbUsers($nbUsers) { $this->nbUsers = $nbUsers; }

    public function __construct()
    {
        $this->nbComments = $this->count('comment', 'id');
        $this->nbCommentsUser = $this->count('comment', 'id', array(
            'user_id' => Session::getSession()->getId()
        ));
        $this->nbTicketsPublish = $this->count('ticket', 'id', array(
            'publish' => 1
        ));
        $this->nbUsers = $this->count('user', 'id');
    }
}