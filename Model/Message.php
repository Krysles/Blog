<?php
namespace App\Model;

class Message extends Mailer
{
    const FROM = 'agence.krysles@gmail.com';
    const FROMNAME = 'Jean Forteroche';

    private $to;
    private $lastname;
    private $firstname;
    private $token;

    public function __construct(USER $user)
    {
        $this->to = $user->getEmail();
        $this->lastname = $user->getLastname();
        $this->firstname = $user->getFirstname();
        $this->token = $user->getConfirmToken();
    }

    function sendRegister()
    {
        $from = array(self::FROM => self::FROMNAME);
        $to = array($this->to => $this->lastname . ' ' . $this->firstname);
        $objet = "Inscription sur le blog Jean Forteroche";
        $content = "Ici je dois transmettre le message avec un token afin de sécuriser le compte -> $this->token.";
        $this->sendEmail($objet, $from, $to, $content);
    }
}