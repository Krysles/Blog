<?php
namespace App\Model;

use \App\Model\User;
use \App\Validator\ValidateUser;
use \App\Core\Database;


class connexion extends Database
{
    private $user;
    private $connexion;
    private $validator;
    private $message = array();

    public function __construct() { $this->user = new User(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getUser() { return $this->user; }

    public function setUser($user) { $this->user->hydrate($user); }

    public function isValid()
    {
        $this->validator = new ValidateUser();
        $this->validator->validEmail($this->user->getEmail());
        $this->validator->validPassword($this->user->getPassword());
        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Veuillez vérifier vos identifiants.");
            return false;
        }
    }
    
    public function connexion()
    {
        if ($this->connectUser()) {
            if (password_verify($this->user->getPassword(), $this->connexion['password'])) {
                $this->user->hydrate($this->getConnexion());
                $this->user->setPassword(null);
                $this->setMessage('success', 'Bienvenue '. ucfirst($this->user->getFirstname()) . ' ' . ucfirst($this->user->getLastname()));
                return true;
            } else {
                $this->setMessage('danger', "Identifiant ou mot de passe incorrect.");
                return false;
            }
        } else {
            $this->setMessage('danger', "Veuillez vérifier vos identifiants.");
            return false;
        }
    }

    private function connectUser()
    {
        $sql = "SELECT id, lastname, firstname, password, registDate, role
                FROM user
                WHERE email = :email AND role >= :role AND confirmToken IS NULL AND registDate IS NOT NULL AND resetToken IS NULL";
        $this->setConnexion($this->runRequest($sql, array(
            ':email' => $this->user->getEmail(),
            ':role' => User::MEMBER
        ))->fetch(\PDO::FETCH_ASSOC));
        return $this->getConnexion();
    }

    public function getConnexion()
    {
        return $this->connexion;
    }

    public function setConnexion($connexion)
    {
        $this->connexion = $connexion;
    }
}