<?php
namespace App\Model;

use \App\Core\Config;
use \App\Core\Mailer;

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

    function sendValidRegister()
    {
        $objet = "Inscription sur le blog Jean Forteroche";
        $content = "Bonjour, afin de valider votre inscription sur le blog de Jean Forteroche, merci de cliquer sur ce lien -> <a href='http://" . $_SERVER['SERVER_NAME'] . "/index.php?controller=register&id=". $this->user->getId() ."&token=" . $this->user->getConfirmToken() . "'>confirmer mon adresse</a>";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }

    function sendConfirmRegister()
    {
        $objet = "Activation de votre compte";
        $content = "Bonjour, votre compte a bien été validé, vous pouvez dès à présent vous connecter.";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }

    function sendValidLostPassword()
    {
        $objet = "Perte de mot de passe sur le blog Jean Forteroche";
        $content = "Bonjour, afin de valider votre demande d'accès et saisir un nouveau mot de passe, merci de cliquer sur ce lien -> <a href='http://" . $_SERVER['SERVER_NAME'] . "/index.php?controller=recovery&id=". $this->user->getId() ."&token=" . $this->user->getResetToken() . "'>récupérer mon accès</a>";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }
    
    function sendConfirmRecovery()
    {
        $objet = "Confirmation d'accès le blog Jean Forteroche";
        $content = "Bonjour, votre compte a bien été validé, vous pouvez dès à présent vous connecter.";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }
    
    
}