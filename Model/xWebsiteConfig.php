<?php
namespace App\Model;

class WebsiteConfig extends Database
{
    public function getConfig()
    {
        $sql = 'SELECT * FROM configuration';
        $config = $this->runRequest($sql)->fetch();
        return $config;
    }
}