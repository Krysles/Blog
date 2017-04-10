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
        if ($this->validValue($image->getError(), 0)) {
            if (!$this->validImageFormat($image->getType())) {
                $this->setErrors('image', "Le fichier attendu n'est pas au bon format.");
            } elseif (!$this->validSize($image->getSize(), self::MAXSIZE)) {
                $this->setErrors('image', "La taille du fichier est trop importante.");
            } elseif (!$this->validExtension($image->getName())) {
                $this->setErrors('image', "L'extension du fichier est incorrecte.");
            }
        } elseif ($this->validValue($image->getError(), 1)) {
            $this->setErrors('image', "La taille du fichier est trop importante.");
        } elseif ($this->validValue($image->getError(), 2)) {
            $this->setErrors('image', "La taille du fichier est trop importante.");
        } elseif ($this->validValue($image->getError(), 3)) {
            $this->setErrors('image', "Le fichier a été partiellement téléchargé.");
        } elseif ($this->validValue($image->getError(), 6)) {
            $this->setErrors('image', "Le dossier temporaire est manquant.");
        } elseif ($this->validValue($image->getError(), 7)) {
            $this->setErrors('image', "Erreur lors de l'écriture du fichier sur le disque.");
        } elseif ($this->validValue($image->getError(), 8)) {
            $this->setErrors('image', "L'envoi du fichier a été arrêté.");
        }
    }
    
    public function validContent($content)
    {
        if (!$this->validNotEmpty($content)) {
            $this->setErrors('content', "Vous devez saisir un contenu.");
        }
    }
}