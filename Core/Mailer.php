<?php
namespace App\Core;

use \Swift_Message;
use \Swift_SmtpTransport;
use \Swift_Mailer;

abstract class Mailer
{
    private static $mailer;

    private static function createMail($objet, $from, $to, $content)
    {
        $mail = \Swift_Message::newInstance();
        $mail->setSubject($objet);
        $mail->setFrom($from);
        $mail->setTo($to);
        $mail->setBody($content, 'text/html');
        return $mail;
    }

    private static function getMailer()
    {
        if (self::$mailer == null) {
            $transport = Config::get("mailtransport");
            $port = Config::get("mailport");
            $security = Config::get("mailsecurity");
            $username = Config::get("mailusername");
            $password = Config::get("mailpassword");
            $transport = \Swift_SmtpTransport::newInstance($transport, $port, $security)
                ->setUsername($username)
                ->setPassword($password);
            self::$mailer = \Swift_Mailer::newInstance($transport);
        }
        return self::$mailer;
    }

    protected function sendEmail($objet, $from, $to, $content)
    {
        if (self::$mailer == null) {
            self::getMailer();
        }
        self::$mailer->send(self::createMail($objet, $from, $to, $content));
    }
}