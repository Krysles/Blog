<?php
namespace App\Model;

class Services
{
    static public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    static public function generateToken($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}