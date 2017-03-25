<?php
namespace App\Model;

use \App\Validator\ValidateUser;
use \App\Model\User;
use \App\Model\Message;

class Lostpassword
{
    private $user;
    private $lostpassword;
    private $validator;
    private $message = array();

    public function __construct() { $this->user = new User(); }

    public function getLostpassword() { return $this->lostpassword; }

    public function setLostpassword($lostpassword) { $this->lostpassword = $lostpassword; }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }
    
    public function getUser() { return $this->user; }

    public function setUser($user) { $this->user->hydrate($user); }

    public function isValid()
    {
        $this->validator = new ValidateUser();
        $this->validator->validEmail($this->user->getEmail());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la validation du formulaire.");
            return false;
        }
    }

    public function lostpassword()
    {
        $this->setLostpassword($this->user->checkUser(array(
            'email' => $this->user->getEmail()
        )));
        if (!empty($this->getLostpassword())) {
            $this->user->hydrate($this->getLostpassword());
            $this->user->setPassword(Services::generateStr(60));
            $this->user->setResetToken(Services::generateStr(60));
            $date = new \DateTime();
            $this->user->setResetDate($date->format('Y-m-d H:i:s')); // Ajouter 24 heures
            $this->user->updateUser(array(
                'password' => $this->user->getPassword(),
                'resetToken' => $this->user->getResetToken(),
                'resetDate' => $this->user->getResetDate()
            ), $this->user->getId());
            $message = new Message($this->user);
            $message->sendValidLostPassword();
        }
        $this->setMessage('success', "Le traitement de votre demande est en cours.");
    }
    
    public function isConfirmed($id, $token)
    {
        $this->setLostpassword($this->user->checkUser(array(
            'id' => $id,
            'resetToken' => $token
        )));
        if (!empty($this->getLostpassword())) {
            $this->setMessage('success', "Vous pouvez maintenant saisir votre nouveau mot de passe.");
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré contactez l'administrateur.");
            return false;
        }
    }
}