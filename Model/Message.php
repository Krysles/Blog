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

    function sendValidRegister()
    {
        $objet = "Inscription sur le blog Jean Forteroche";
        $content = "Bonjour, afin de valider votre inscription sur le blog de Jean Forteroche, merci de cliquer sur ce lien -> <a href='http://jeanforteroche/index.php?controller=home&action=register&id=". $this->user->getId() ."&token=" . $this->user->getConfirmToken() . "'>confirmer mon adresse</a>";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }

    function sendConfirmRegister()
    {
        $objet = "Activation de votre compte";
        $content = "Bonjour, votre compte a bien été validé, vous pouvez dès à présent vous connecter.";
        $this->sendEmail($objet, $this->from, $this->to, $content);
    }
}