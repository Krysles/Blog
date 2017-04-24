<?php
namespace App\Model;

use \App\Core\Database;

class Configuration extends Database
{
    private $title;
    private $subtitle;

    public function __construct() {  }

    public function getTitle() { return $this->title; }

    public function setTitle($title) { $this->title = $title; }

    public function getSubtitle() { return $this->subtitle; }

    public function setSubtitle($subtitle) { $this->subtitle = $subtitle; }

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
}