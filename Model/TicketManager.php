<?php
namespace App\Model;

class TicketManager
{
    const IMGDIRECTORY = 'style/images/episodes/';

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

    public function setTicket($ticket, $image = array())
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
        if ($this->ticket->getImage()->getError() == 0) {

            $baseFileName = Services::createBaseFilename(1, $this->ticket->getNextId('ticket')['Auto_increment']);
            $extFileName = Services::getExtension($this->ticket->getImage()->getName());

            $fileName = $baseFileName . '.' . strtolower($extFileName);

            Services::createDirectory(self::IMGDIRECTORY);

            $url = self::IMGDIRECTORY . $fileName;

            $tmp_name = $this->ticket->getImage()->getTmp_name();
            move_uploaded_file($tmp_name, $url);

            $this->ticket->setImgUrl('/' . $url);

        }
        $this->ticket->setNumber($this->ticket->getLast('ticket', 'number')->number + 1);
        $this->ticket->insert($user->getId());

        $this->setMessage('success', "L'épisode a bien été créé.");
    }

    public function update($user)
    {
        if ($this->ticket->getImage()->getError() == 0) {
            
            Services::deleteFile(substr($this->getTicket()->getImgUrl(), 1));

            $baseFileName = Services::createBaseFilename(1, $this->getTicket()->getId());
            $extFileName = Services::getExtension($this->ticket->getImage()->getName());

            $fileName = $baseFileName . '.' . strtolower($extFileName);

            Services::createDirectory(self::IMGDIRECTORY);


            $url = self::IMGDIRECTORY . $fileName;

            $tmp_name = $this->ticket->getImage()->getTmp_name();
            move_uploaded_file($tmp_name, $url);

            $this->ticket->setImgUrl('/' . $url);

        }
        $this->ticket->update($user->getId());

        $this->setMessage('success', "L'épisode a bien été mis à jour.");
    }
    
    public function deleteimage($user)
    {
        Services::deleteFile(substr($this->getTicket()->getImgUrl(), 1));
        $this->ticket->setImgUrl(null);
        $this->ticket->update($user->getId());
        $this->setMessage('success', "L'image a bien été supprimé.");
    }
}