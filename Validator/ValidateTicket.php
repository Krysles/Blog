<?php
namespace App\Validator;

use \App\Validator\Validator;

class ValidateTicket extends Validator
{
    const MAXSIZE = 6144000;
    
    private $errors = array();

    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }

    public function validTitle($title)
    {
        if (!$this->validNotEmpty($title)) {
            $this->setErrors('title', "Vous devez saisir un titre.");
        }
    }
    
    public function validImage($image)
    {
        if (!$this->validValue($image->getError(), 0)) {
            $this->setErrors('image', "Une erreur a été rencontré lors de l'envoi du fichier.");
        } elseif (!$this->validImageFormat($image->getType())) {
            $this->setErrors('image', "Le fichier attendu n'est pas au bon format.");
        } elseif (!$this->validSize($image->getSize(), self::MAXSIZE)) {
            $this->setErrors('image', "La taille du fichier est trop importante.");
        } elseif (!$this->validExtension($image->getName())) {
            $this->setErrors('image', "L'extension du fichier est incorrecte.");
        }
    }
    
    public function validContent($content)
    {
        if (!$this->validNotEmpty($content)) {
            $this->setErrors('content', "Vous devez saisir un contenu.");
        }
    }
}