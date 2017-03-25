<?php
namespace App\Core;

use \App\Core\Database;

class WebsiteConfig extends Database
{
    public function getConfig()
    {
        $sql = 'SELECT * FROM configuration';
        $config = $this->runRequest($sql)->fetch();
        return $config;
    }
}