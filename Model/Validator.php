<?php
namespace App\Model;

class Validator extends \App\Core\Database
{
    private $errors = array();

    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }

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

    private function checkEmail($email)
    {
        $sql = 'SELECT COUNT(email) AS total FROM user WHERE email = ?';
        if ($this->runRequest($sql, array($email))->fetch()->total != 0) {
            return true;
        } else {
            return false;
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

    public function validLastname($lastname)
    {
        if (!$this->validNotEmpty($lastname)) {
            $this->setErrors('lastname', "Vous devez saisir votre nom.");
        }
        if (!$this->validAlphanumeric($lastname)) {
            $this->setErrors('lastname', "Le nom doit contenir des lettres de A à Z.");
        }
        if (!$this->validLength($lastname, 20)) {
            $this->setErrors('lastname', "Le nom peut contenir 20 caractères maximum.");
        }
    }

    public function validFirstname($firstname)
    {
        if (!$this->validNotEmpty($firstname)) {
            $this->setErrors('firstname', "Vous devez saisir votre prénom.");
        }
        if (!$this->validAlphanumeric($firstname)) {
            $this->setErrors('firstname', "Le prénom doit contenir des lettres de A à Z.");
        }
        if (!$this->validLength($firstname, 20)) {
            $this->setErrors('firstname', "Le prénom peut contenir 20 caractères maximum.");
        }
    }

    public function validEmail($email)
    {
        if (!$this->validNotEmpty($email)) {
            $this->setErrors('email', "Vous devez saisir votre adresse email.");
        } elseif (!$this->validEmailFormat($email)) {
            $this->setErrors('email', "L'adresse email n'est pas au bon format.");
        } elseif (!$this->validLength($email, 40)) {
            $this->setErrors('email', "L'adresse email peut contenir 40 caractères maximum.");
        }
    }

    public function validEmailNotExist($email)
    {
        if ($this->checkEmail($email)) {
            $this->setErrors('email', "L'adresse email est déjà inscrite.");
        }
    }
    
    public function validPassword($password)
    {
        if (!$this->validNotEmpty($password)) {
            $this->setErrors('password', "Vous devez saisir un mot de passe.");
        }
        if (!$this->validLength($password, 15)) {
            $this->setErrors('password', "Le mot de passe peut contenir 15 caractères maximum.");
        }
    }

    public function validPasswords($password, $confirmPassword)
    {
        if (!$this->validIdenticalValues($password, $confirmPassword)) {
            $this->setErrors('password', "Les mots de passe ne sont pas identiques.");
        }
    }

}