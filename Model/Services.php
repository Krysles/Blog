<?php
namespace App\Model;

class Services
{
    static public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    static public function generateStr($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static public function getExtension($file)
    {
        $file = new \SplFileInfo($file);
        return $file->getExtension();
    }

    static public function createBaseFilename($bookId, $nextTicketId)
    {
        $bookId = str_pad($bookId, 3, "0", STR_PAD_LEFT);
        $nextTicketId = str_pad($nextTicketId, 5, "0", STR_PAD_LEFT);
        return $bookId . $nextTicketId;
    }
    
    static public function createDirectory($rep)
    {
        if (!is_dir($rep)) {
            if (!mkdir($rep, 0755)) {
                throw new \Exception("Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !");
            }
        }
    }
    
    static public function deleteFile($url)
    {
        if (file_exists($url)) {
            unlink($url);
        }
    }
}