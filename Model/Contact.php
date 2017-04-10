<?php
namespace App\Model;

use \App\Core\Database;
use \App\Model\Message;
use \App\Validator\ValidateContact;

class Contact extends Database
{
    private $contact;
    private $validator;
    private $message = array();

    public function __construct() { }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getContact() { return $this->contact; }

    public function setContact($contact) { $this->contact = $contact; }

    public function isValid()
    {
        $this->validator = new ValidateContact();
        
        $this->validator->validName($this->contact['name']);
        $this->validator->validEmail($this->contact['email']);
        $this->validator->validSubject($this->contact['subject']);
        $this->validator->validMessage($this->contact['message']);
        
        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de l'envoi.");
            return false;
        }
    }

    public function send()
    {
        $message = new Message();
        $message->sendMessage($this->contact['name'], $this->contact['email'], $this->contact['subject'], $this->contact['message']);
        $this->setMessage('success', "L'email a bien été envoyé.");
    }
}