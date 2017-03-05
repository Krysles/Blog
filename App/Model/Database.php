<?php
namespace App\Model;

abstract class Database
{
    private static $bdd;

    private static function getBdd()
    {
        if (self::$bdd == null) {
            $dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $password = Configuration::get("password");
            self::$bdd = new PDO($dsn, $login, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                // AJOUT RECUP EN OBJET ?
            ));
        }
        return self::$bdd;
    }

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
}