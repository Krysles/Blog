<?php
namespace App\Model;

class Register extends Database
{
    private $user;
    private $register;
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
        $this->validator->validLastname($this->user->getLastname());
        $this->validator->validFirstname($this->user->getFirstname());
        $this->validator->validEmail($this->user->getEmail());
        $this->validator->validEmailNotExist($this->user->getEmail());
        $this->validator->validPassword($this->user->getPassword());
        $this->validator->validPasswords($this->user->getPassword(), $this->user->getConfirmPassword());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de l'inscription.");
            return false;
        }
    }

    public function register()
    {
        $this->user->setPassword(Services::hashPassword($this->user->getPassword()));
        $this->user->setConfirmPassword(null);
        $this->user->setConfirmToken(Services::generateToken(60));
        $this->user->setRole(USER::VISITOR);
        $this->user->insertUser();
        $message = new \App\Model\Message($this->user);
        $message->sendValidRegister();
        $this->setMessage('success', "Un email de confirmation vient de vous êtes envoyé.");
    }

    public function isConfirmed($id, $token)
    {
        if ($this->checkRegister($id, $token)) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré contactez l'administrateur.");
            return false;
        }
    }

    public function checkRegister($id, $token)
    {
        $sql = 'SELECT id, lastname, firstname, email, role, confirmToken FROM user WHERE id = ? AND confirmToken = ?';
        $this->setRegister($this->runRequest($sql, array($id, $token))->fetch(\PDO::FETCH_ASSOC));
        return $this->getRegister();
    }

    public function getRegister()
    {
        return $this->register;
    }

    public function setRegister($register)
    {
        $this->register = $register;
    }

    public function valideRegister()
    {
        $this->user->hydrate($this->register);
        $this->user->setConfirmToken(null);
        $this->user->setRole(USER::MEMBER);
        $this->user->updateUser();
        $message = new \App\Model\Message($this->user);
        $message->sendConfirmRegister();
        $this->setMessage('success', "Votre compte a bien été validé.");
    }
}