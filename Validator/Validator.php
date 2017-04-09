<?php
namespace App\Validator;

use \App\Core\Database;
use App\Model\Services;

abstract class Validator extends Database
{
    const TYPEFILE = array(
        'image/jpg',
        'image/jpeg',
        'image/png'
    );

    const EXTFILE = array(
        'jpg',
        'jpeg',
        'png'
    );

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

    public function validNumeric($value)
    {
        if (is_numeric($value)) {
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

    public function validValue($value, $integer)
    {
        if ($value == $integer) {
            return true;
        }
    }

    public function validImageFormat($value)
    {
        if (in_array($value, self::TYPEFILE)) {
            return true;
        }
    }

    public function validSize($value, $integer)
    {
        if ($value <= $integer) {
            return true;
        }
    }

    public function validExtension($value)
    {
        if (in_array(strtolower(Services::getExtension($value)), self::EXTFILE)) {
            return true;
        }
    }
}