<?php
namespace App\Validator;

use \App\Validator\Validator;

class ValidateComment extends Validator
{
    private $errors = array();

    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }
    
    public function validContent($content)
    {
        if (!$this->validNotEmpty($content)) {
            $this->setErrors('content', "Vous devez saisir un commentaire.");
        }
    }
}