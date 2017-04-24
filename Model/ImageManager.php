<?php
namespace App\Model;

class ImageManager
{
    const IMGDIRECTORY = 'style/photos/';
    
    private $image;

    public function __construct()
    {
        $this->image = new \App\Model\Image();
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image->hydrate($image);
    }

    public function process($ticket, $book = 1)
    {
        $baseFileName = Services::createBaseFilename($book, $ticket->getId());
        $extFileName = Services::getExtension($this->getImage()->getName());

        $fileName = $baseFileName . '.' . strtolower($extFileName);

        Services::createDirectory(self::IMGDIRECTORY);

        $url = self::IMGDIRECTORY . $fileName;

        $tmp_name = $this->getImage()->getTmp_name();
        move_uploaded_file($tmp_name, $url);

        $ticket->setImgUrl('/' . $url);
    }
}