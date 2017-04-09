<?php
namespace App\Core;

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
            foreach($params as $key => $value) {
                if (is_numeric($value)) {
                    $result->bindValue($key, $value, PDO::PARAM_INT);
                } else {
                    $result->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
            $result->execute();
            //$result->execute($params);
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

    protected function getLastInsertId()
    {
        return self::$bdd->lastInsertId();
    }

    public function getLast($table, $column)
    {
        $sql = "SELECT MAX($column) AS number FROM $table";
        return $this->runRequest($sql)->fetch();
    }

    public function getNextId($table)
    {
        $sql = "SHOW TABLE STATUS FROM jeanforteroche LIKE '$table'";
        return $this->runRequest($sql)->fetch(\PDO::FETCH_ASSOC);
    }
}