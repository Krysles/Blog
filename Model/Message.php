<?php
namespace App\Model;

class Message extends Mailer
{
    private $user;
    private $from;
    private $to;

    public function __construct(USER $user)
    {
        $this->user = $user;
        $this->from = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $this->to = array($this->user->getEmail() => $this->user->getLastname() . ' ' . $this->user->getFirstname());
    }

    function sendRegister()
    {
        $objet = "Inscription sur le blog Jean Forteroche";
        $content = "Ici je dois transmettre le message avec un token afin de sécuriser le compte -> " . $this->user->getConfirmToken() . ".";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }
}