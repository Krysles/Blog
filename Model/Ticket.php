<?php
namespace App\Model;


use App\Core\Database;

class Ticket extends Database
{
    private $id;
    private $number;
    private $title;
    private $content;
    private $imgUrl;
    private $image;
    private $publish = 0;
    private $date;


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

    public function getNumber() { return $this->number; }

    public function setNumber($number) { $this->number = $number; }

    public function getTitle() { return $this->title; }

    public function setTitle($title) { $this->title = $title; }

    public function getContent() { return $this->content; }

    public function setContent($content) { $this->content = $content; }

    public function getImgUrl() { return $this->imgUrl; }

    public function setImgUrl($imgUrl) { $this->imgUrl = $imgUrl; }

    public function getImage() { return $this->image; }

    public function setImage($image) { $this->image = new Image($image); }

    public function getPublish() { return $this->publish; }

    public function setPublish($publish) { $this->publish = $publish; }

    public function getDate() { return $this->date; }

    public function setDate($date) { $this->date = $date; }

    public function insert($userId)
    {
        $sql = "INSERT INTO ticket SET number = :number, title = :title, content = :content, imgUrl = :imgUrl, publish = :publish, date = NOW(), book_id = :bookId, user_id = :userId";
        $this->runRequest($sql, array(
            ':number' => $this->getNumber(),
            ':title' => $this->getTitle(),
            ':content' => $this->getContent(),
            ':imgUrl' => $this->getImgUrl(),
            ':publish' => $this->getPublish(),
            ':bookId' => 1,
            ':userId' => $userId
        ));
    }
}