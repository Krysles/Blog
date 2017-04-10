<?php
namespace App\Model;

use \App\Core\Config;
use \App\Core\Mailer;

class Message extends Mailer
{

    function sendValidRegister($user)
    {
        $from = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $to = array($user->getEmail() => $user->getLastname() . ' ' . $user->getFirstname());
        $objet = "Inscription sur le blog Jean Forteroche";
        $content = "Bonjour, afin de valider votre inscription sur le blog de Jean Forteroche, merci de cliquer sur ce lien -> <a href='http://" . $_SERVER['SERVER_NAME'] . "/index.php?controller=register&id=" . $user->getId() . "&token=" . $user->getConfirmToken() . "'>confirmer mon adresse</a>";
        $this->sendEmail($objet, $from, $to, $content);
    }

    function sendConfirmRegister($user)
    {
        $from = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $to = array($user->getEmail() => $user->getLastname() . ' ' . $user->getFirstname());
        $objet = "Activation de votre compte";
        $content = "Bonjour, votre compte a bien été validé, vous pouvez dès à présent vous connecter.";
        $this->sendEmail($objet, $from, $to, $content);
    }

    function sendValidLostPassword($user)
    {
        $from = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $to = array($user->getEmail() => $user->getLastname() . ' ' . $user->getFirstname());
        $objet = "Perte de mot de passe sur le blog Jean Forteroche";
        $content = "Bonjour, afin de valider votre demande d'accès et saisir un nouveau mot de passe, merci de cliquer sur ce lien -> <a href='http://" . $_SERVER['SERVER_NAME'] . "/index.php?controller=recovery&id=" . $user->getId() . "&token=" . $user->getResetToken() . "'>récupérer mon accès</a>";
        $this->sendEmail($objet, $from, $to, $content);
    }

    function sendConfirmRecovery($user)
    {
        $from = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $to = array($user->getEmail() => $user->getLastname() . ' ' . $user->getFirstname());
        $objet = "Confirmation d'accès le blog Jean Forteroche";
        $content = "Bonjour, votre compte a bien été validé, vous pouvez dès à présent vous connecter.";
        $this->sendEmail($objet, $from, $to, $content);
    }

    function sendMessage($name, $email, $subject, $content)
    {
        $from = array($email => $name);
        $to = array(Config::get("maileraddress") => Config::get("mailerauthor"));
        $objet = "Contact de " . $email . " : " . $subject;
        $this->sendEmail($objet, $from, $to, $content);
    }
}