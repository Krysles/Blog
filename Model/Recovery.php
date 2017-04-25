<?php
namespace App\Model;

use \App\Validator\ValidateUser;
use \App\Model\User;
use \App\Model\Message;

class Recovery
{
    private $user;
    private $recovery;
    private $validator;
    private $message = array();

    public function __construct() { $this->user = new User(); }

    public function getRecovery() { return $this->recovery; }

    public function setRecovery($recovery) { $this->recovery = $recovery; }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }
    
    public function getUser() { return $this->user; }

    public function setUser($user) { $this->user->hydrate($user); }

    public function isValid()
    {
        $this->validator = new ValidateUser();
        $this->validator->validPassword($this->user->getPassword());
        $this->validator->validPasswords($this->user->getPassword(), $this->user->getConfirmPassword());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la validation du formulaire.");
            return false;
        }
    }

    public function recovery()
    {
        $this->user->setPassword(Services::hashPassword($this->user->getConfirmPassword()));
        $this->user->setConfirmPassword(NULL);
        $this->user->updateUser(array(
            'password' => $this->user->getPassword(),
            'resetToken' => NULL,
            'resetDate' => $this->user->getResetDate()
        ), $this->user->getId());
        $message = new Message();
        $message->sendConfirmRecovery($this->user);
        $this->setMessage('success', "Votre compte a bien été mis à jour.");
    }
}