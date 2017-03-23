<?php
namespace App\Core;

class WebsiteConfig extends \App\Core\Database
{
    public function getConfig()
    {
        $sql = 'SELECT * FROM configuration';
        $config = $this->runRequest($sql)->fetch();
        return $config;
    }
}