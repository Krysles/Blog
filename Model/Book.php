<?php
namespace App\Model;

use \App\Core\Database;

class Book extends Database
{
    private $id;
    private $title;
    private $subtitle;
    private $summary;
    private $imgUrl;
    private $firstname;
    private $lastname;

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

    public function getTitle() { return $this->title; }

    public function setTitle($title) { $this->title = $title; }

    public function getSubtitle() { return $this->subtitle; }

    public function setSubtitle($subtitle) { $this->subtitle = $subtitle; }

    public function getSummary() { return $this->summary; }

    public function setSummary($summary) { $this->summary = $summary; }

    public function getImgUrl() { return $this->imgUrl; }

    public function setImgUrl($imgUrl) { $this->imgUrl = $imgUrl; }

    public function getFirstname() { return $this->firstname; }

    public function setFirstname($firstname) { $this->firstname = $firstname; }

    public function getLastname() { return $this->lastname; }

    public function setLastname($lastname) { $this->lastname = $lastname; }
}