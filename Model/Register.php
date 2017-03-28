<?php
namespace App\Model;

use \App\Core\Database;
use \App\Model\User;
use \App\Model\Message;
use \App\Validator\ValidateUser;

class Register extends Database
{
    private $user;
    private $register;
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
        $this->user->setConfirmToken(Services::generateStr(60));
        $this->user->setRole(USER::VISITOR);
        $this->user->insertUser();
        $this->user->setId($this->user->getLastInsertId());
        $message = new Message($this->user);
        $message->sendValidRegister();
        $this->setMessage('success', "Un email de confirmation vient de vous êtes envoyé.");
    }

    public function isConfirmed($id, $token)
    {
        $this->setRegister($this->user->checkUser(array(
            'id' => $id,
            'confirmToken' => $token)));
        if ($this->getRegister()) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré contactez l'administrateur.");
            return false;
        }
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
        $date = new \DateTime();
        $this->user->setRegistDate($date->format('Y-m-d H:i:s'));
        $this->user->updateUser(array(
            'confirmToken' => $this->user->getConfirmToken(),
            'role' => $this->user->getRole(),
            'registDate' => $this->user->getRegistDate()
        ), $this->user->getId());

        $message = new Message($this->user);
        $message->sendConfirmRegister();
        $this->setMessage('success', "Votre compte a bien été validé.");
    }
}