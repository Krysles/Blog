<?php
namespace App\Controller;

use App\Model\Controller;

class Home extends Controller
{
    private $websiteConfig;
    private $book;

    public function __construct()
    {
        // est ce utile car pas besoin dans les autres actions...
        $this->websiteConfig = new \App\Model\WebsiteConfig();
        $this->book = new \App\Model\Book();
    }

    public function index($bookname)
    {
        $config = $this->websiteConfig->getConfig();
        $book = $this->book->getTheLastBook();
        $this->generateView(array(
            'config' => $config,
            'book' => $book
        ));
    }

    public function register()
    {
        if ($this->request->existParam('post', 'register')) {
            $datasForm = $this->request->getParams('post');
            $register = new \App\Model\Register($datasForm);
            if ($register->isValid()) {
                
                
                // On inscrit l'utilisateur
                // -> hacher le pass
                // -> lui mettre un role
                // -> générer le token
                // -> inscrire en bdd
                // -> envoyer le mail



                
                $_SESSION['flash']['success'] = "Un email de confirmation vient de vous êtes envoyé.";
            } else {
                $_SESSION['register'] = $register->getUser();
                $_SESSION['errors'] = $register->getErrors();
                $_SESSION['flash']['danger'] = "Un problème a été rencontré lors de l'inscription.";
            }
        }
        header('Location: /#register');
        exit();
    }
}