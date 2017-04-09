<?php
namespace App\Model;

class TicketManager
{
    private $ticket;
    private $validator;
    private $message = array();

    public function __construct()
    {
        $this->ticket = new \App\Model\Ticket();
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket($ticket, $image)
    {
        $this->ticket->hydrate($ticket);
        $this->ticket->setImage($image);
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($alert, $error)
    {
        $this->message[$alert] = $error;
    }

    public function isValid()
    {
        $this->validator = new \App\Validator\ValidateTicket();
        $this->validator->validTitle($this->ticket->getTitle());
        $this->validator->validImage($this->ticket->getImage());
        $this->validator->validContent($this->ticket->getContent());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la création de l'épisode.");
            return false;
        }
    }

    public function insert($user)
    {

        $bookId = $this->ticket->getLast('book', 'id')->number;

        $nextTicketId = $this->ticket->getNextId('ticket')['Auto_increment'];


        // création du nouveau nom de fichier
        $bookId = str_pad($bookId, 3, "0", STR_PAD_LEFT);
        $nextTicketId = str_pad($nextTicketId, 5, "0", STR_PAD_LEFT);
        $baseFileName = $bookId . $nextTicketId;
        $extFileName = Services::getExtension($this->ticket->getImage()->getName());
        $fileName = $baseFileName . '.' . strtolower($extFileName);

        // récupération du fichier tmp
        $tmp_name = $this->ticket->getImage()->getTmp_name();

        // création du répertoire si inexistant
        $rep = 'style/images/episodes/';
        if (!is_dir($rep)) {
            if (!mkdir($rep, 0755)) {
                throw new \Exception("Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !");
            }
        }
        $url = $rep . $fileName;
        move_uploaded_file($tmp_name, $url);

        $this->ticket->setImgUrl('/' . $url);

        $this->ticket->setNumber($this->ticket->getLast('ticket', 'number')->number + 1);

        $this->ticket->insert($user->getId());
        
        $this->setMessage('success', "L'épisode a bien été créé.");
    }
}