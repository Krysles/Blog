<?php
namespace App\Model;

use \PDO;

abstract class Database
{
    private static $bdd;

    protected function runRequest($sql, $params = null)
    {
        if ($params == null) {
            $result = self::getBdd()->query($sql);
        } else {
            $result = self::getBdd()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }

    private static function getBdd()
    {
        if (self::$bdd == null) {
            $dsn = Config::get("bddsn");
            $login = Config::get("bdlogin");
            $password = Config::get("bdpassword");
            self::$bdd = new PDO($dsn, $login, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ));
        }
        return self::$bdd;
    }
}