<?php
namespace App\Model;

class Register
{
    private $user;
    private $errors = array();

    public function __construct($datasForm)
    {
        $this->user = new \App\Model\User($datasForm);
    }

    public function getErrors() { return $this->errors; }

    public function setErrors($fieldname, $error) { $this->errors[$fieldname] = $error; }

    public function getUser() { return $this->user; }

    public function isValid()
    {
        $this->isValidLastname($this->user->getLastname());
        $this->isValidFirstname($this->user->getFirstname());
        $this->isValidEmail($this->user->getEmail());
        $this->isValidPassword($this->user->getPassword(), $this->user->getConfirmPassword());
        $this->isValidRole('visitor');
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidLastname($lastname)
    {
        if (!Validator::validNotEmpty($lastname)) {
            $this->setErrors('lastname', "Vous devez saisir votre nom.");
        }
        if (!Validator::validAlphanumeric($lastname)) {
            $this->setErrors('lastname', "Le nom doit contenir des lettres de A à Z.");
        }
        if (!Validator::validLength($lastname, 20)) {
            $this->setErrors('lastname', "Le nom peut contenir 20 caractères maximum.");
        }
    }

    private function isValidFirstname($firstname)
    {
        if (!Validator::validNotEmpty($firstname)) {
            $this->setErrors('firstname', "Vous devez saisir votre prénom.");
        }
        if (!Validator::validAlphanumeric($firstname)) {
            $this->setErrors('firstname', "Le prénom doit contenir des lettres de A à Z.");
        }
        if (!Validator::validLength($firstname, 20)) {
            $this->setErrors('firstname', "Le prénom peut contenir 20 caractères maximum.");
        }
    }

    private function isValidEmail($email)
    {
        if (!Validator::validNotEmpty($email)) {
            $this->setErrors('email', "Vous devez saisir votre adresse email.");
        }
        if (!Validator::validEmailFormat($email)) {
            $this->setErrors('email', "L'adresse email n'est pas au bon format.");
        }
        if (!Validator::validEmailNotExist($this->user)) {
            $this->setErrors('email', "L'adresse email est déjà inscrite.");
        }
        if (!Validator::validLength($email, 40)) {
            $this->setErrors('email', "L'adresse email peut contenir 40 caractères maximum.");
        }
    }

    private function isValidPassword($password, $confirmPassword)
    {
        if (!Validator::validNotEmpty($password)) {
            $this->setErrors('confirmPassword', "Vous devez saisir un mot de passe.");
        }
        if (!Validator::validIdenticalValues($password, $confirmPassword)) {
            $this->setErrors('confirmPassword', "Les mots de passe ne sont pas identiques.");
        }
        if (!Validator::validLength($password, 15)) {
            $this->setErrors('confirmPassword', "Le mot de passe peut contenir 15 caractères maximum.");
        }
    }

    private function isValidRole($value)
    {
        if (!Validator::validRole($this->user, $value)) {
            throw new \Exception("Un problème est survenu lors de l'inscription.");
        }
    }

    public function register()
    {
        $this->user->setPassword(Services::hashPassword($this->user->getPassword()));
        $this->user->setConfirmPassword(null);
        $this->user->setConfirmToken(Services::generateToken(60));
        $this->user->insertUser();
        $message = new \App\Model\Message($this->user);
        $message->sendRegister();
    }
}