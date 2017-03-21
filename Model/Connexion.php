<?php
namespace App\Model;

class connexion extends Database
{
    private $user;
    private $connexion;
    private $validator;
    private $message = array();

    public function __construct() { $this->user = new \App\Model\User(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getUser() { return $this->user; }

    public function setUser($user) { $this->user->hydrate($user); }

    public function isValid()
    {
        $this->validator = new \App\Model\Validator();
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
        if ($this->checkUser()) {
            if (password_verify($this->user->getPassword(), $this->connexion['password'])) {
                $this->user->hydrate($this->getConnexion());
                $this->user->setPassword(null);
                $this->setMessage('success', 'Bienvenue '. $this->user->getFirstname() . ' ' . $this->user->getLastname());
                $this->setMessage('success', 'Bienvenue '. $this->user->getFirstname() . ' ' . $this->user->getLastname());
                return true;
            } else {
                $this->setMessage('danger', "Veuillez vérifier vos identifiants.");
                return false;
            }
        } else {
            $this->setMessage('danger', "Veuillez vérifier vos identifiants.");
            return false;
        }
    }

    private function checkUser()
    {
        $sql = "SELECT id, lastname, firstname, password, registDate, role
                FROM user
                WHERE email = ? AND role >= ? AND confirmToken IS NULL AND registDate IS NOT NULL";
        $this->setConnexion($this->runRequest($sql, array($this->user->getEmail(), USER::MEMBER))->fetch(\PDO::FETCH_ASSOC));
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