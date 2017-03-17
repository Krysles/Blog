<?php
namespace App\Model;

class Validator
{
    static function validNotEmpty($value)
    {
        if (!empty($value)) {
            return true;
        }
    }

    static function validAlphanumeric($value)
    {
        if (preg_match("#^[A-Za-zéêèëàâäçîïôöùüÿ]*$#", $value)) {
            return true;
        }
    }

    static function validEmailFormat($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }

    static function validEmailNotExist(User $user)
    {
        if (!$user->checkEmail()) {
            return true;
        }
    }

    static function validIdenticalValues($first, $second)
    {
        if ($first == $second) {
            return true;
        }
    }

    static function validLength($value, $int)
    {
        if (strlen($value) <= $int) {
            return true;
        }
    }

    static function validRole(User $user, $role)
    {
        if ($user->getRole() == $role) {
            return true;
        }
    }

}