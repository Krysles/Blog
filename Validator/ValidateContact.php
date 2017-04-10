<?php
namespace App\Validator;

use \App\Validator\Validator;

class ValidateContact extends Validator
{
    private $errors = array();
    
    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }
    
    public function validName($name)
    {
        if (!$this->validNotEmpty($name)) {
            $this->setErrors('name', "Vous devez saisir votre nom.");
        }
        if (!$this->validAlphanumeric($name)) {
            $this->setErrors('name', "Le nom doit contenir des lettres de A à Z.");
        }
        if (!$this->validLength($name, 20)) {
            $this->setErrors('name', "Le nom peut contenir 20 caractères maximum.");
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

    public function validSubject($subject)
    {
        if (!$this->validNotEmpty($subject)) {
            $this->setErrors('subject', "Vous devez saisir un sujet.");
        }
    }

    public function validMessage($message)
    {
        if (!$this->validNotEmpty($message)) {
            $this->setErrors('message', "Vous devez saisir un message.");
        }
    }
}