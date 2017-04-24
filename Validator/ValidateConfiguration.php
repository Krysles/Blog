<?php
namespace App\Validator;

use \App\Validator\Validator;

class ValidateConfiguration extends Validator
{
    private $errors = array();

    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }

    public function validTitle($title)
    {
        if (!$this->validNotEmpty($title)) {
            $this->setErrors('title', "Vous devez saisir un titre.");
        }
        if (!$this->validLength($title, 40)) {
            $this->setErrors('title', "Le titre peut contenir 40 caractères maximum.");
        }
    }

    public function validSubtitle($subtitle)
    {
        if (!$this->validNotEmpty($subtitle)) {
            $this->setErrors('subtitle', "Vous devez saisir une accroche.");
        }
        if (!$this->validLength($subtitle, 70)) {
            $this->setErrors('subtitle', "L'accroche peut contenir 70 caractères maximum.");
        }
    }
}