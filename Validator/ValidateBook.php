<?php
namespace App\Validator;

use \App\Validator\Validator;

class ValidateBook extends Validator
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
        if (!$this->validLength($title, 100)) {
            $this->setErrors('title', "Le titre peut contenir 100 caractères maximum.");
        }
    }

    public function validSubtitle($subtitle)
    {
        if (!$this->validNotEmpty($subtitle)) {
            $this->setErrors('subtitle', "Vous devez saisir un sous-titre.");
        }
        if (!$this->validLength($subtitle, 150)) {
            $this->setErrors('subtitle', "Le sous-titre peut contenir 150 caractères maximum.");
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

    public function validSummary($summary)
    {
        if (!$this->validNotEmpty($summary)) {
            $this->setErrors('summary', "Vous devez saisir un résumé.");
        }
        if (!$this->validLength($summary, 1200)) {
            $this->setErrors('summary', "Le résumé peut contenir 1200 caractères maximum.");
        }
    }
}