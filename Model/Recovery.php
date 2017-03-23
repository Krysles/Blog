<?php
namespace App\Model;

class Recovery
{
    private $user;
    private $recovery;
    private $validator;
    private $message = array();

    public function __construct() { $this->user = new \App\Model\User(); }

    public function getRecovery() { return $this->recovery; }

    public function setRecovery($recovery) { $this->recovery = $recovery; }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }
    
    public function getUser() { return $this->user; }

    public function setUser($user) { $this->user->hydrate($user); }

    public function isValid()
    {
        $this->validator = new \App\Model\Validator();
        $this->validator->validEmail($this->user->getEmail());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la validation du formulaire.");
            return false;
        }
    }

    public function recovery()
    {
        $this->setRecovery($this->user->checkUser(array('email' => $this->user->getEmail())));
        if (!empty($this->getRecovery())) {

            echo 'email ok';
        } else {
            $this->setMessage('danger', "EST CE QUE JE DIS SI EMAIL OK.");

            echo 'email non ok';
        }



        $this->user->setConfirmToken(Services::generateStr(60));

        print_r($this->getRecovery());
        die();
    }
}