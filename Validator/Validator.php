<?php
namespace App\Validator;

use \App\Core\Database;

abstract class Validator extends Database
{
    public function validNotEmpty($value)
    {
        if (!empty($value)) {
            return true;
        }
    }

    public function validAlphanumeric($value)
    {
        if (preg_match("#^[A-Za-zéêèëàâäçîïôöùüÿ]*$#", $value)) {
            return true;
        }
    }

    public function validEmailFormat($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }
    
    public function validIdenticalValues($first, $second)
    {
        if ($first == $second) {
            return true;
        }
    }

    public function validLength($value, $int)
    {
        if (strlen($value) <= $int) {
            return true;
        }
    }
}