<?php
namespace App\Controller;

use App\Model\Controller;

class Home extends Controller
{
    private $websiteConfig;
    private $book;

    public function __construct()
    {

    }

    public function index($bookname)
    {
        $this->websiteConfig = new \App\Model\WebsiteConfig();
        $this->book = new \App\Model\Book();
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
            $register = new \App\Model\Register();
            $register->setUser($datasForm);
            if ($register->isValid()) {
                $register->register();
                $_SESSION['flash']['success'] = "Un email de confirmation vient de vous êtes envoyé.";
                header('Location: /');
                exit();
            } else {
                $_SESSION['register'] = $register->getUser();
                $_SESSION['errors'] = $register->getErrors();
                $_SESSION['flash']['danger'] = "Un problème a été rencontré lors de l'inscription.";
                header('Location: /#register');
                exit();
            }
        }
        if ($this->request->existParam('get', 'token') && $this->request->existParam('get', 'id')) {
            $register = new \App\Model\Register();
            $id = $this->request->getParam('get', 'id');
            $token = $this->request->getParam('get', 'token');
            if ($register->isConfirmed($id, $token)) {
                $register->valideRegister();
                $_SESSION['flash']['success'] = "Votre compte a bien été validé.";
                header('Location: /#connexion');
                exit();
            } else {
                $_SESSION['flash']['danger'] = "Un problème a été rencontré contactez l'administrateur.";
                header('Location: /');
                exit();
            }
        }
        header('Location: /');
        exit();
    }
}