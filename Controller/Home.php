<?php
namespace App\Controller;

use App\Core\Controller;

class Home extends Controller
{
    private $websiteConfig;
    private $book;

    public function __construct()
    {

    }

    public function index($bookname)
    {
        $this->websiteConfig = new \App\Core\WebsiteConfig();
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
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('registerForm', $register->getUser());
                $this->request->getSession()->setAttribut('registerErrors', $register->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
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
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /#connexion');
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', $register->getMessage());
                header('Location: /');
                exit();
            }
        }
        header('Location: /');
        exit();
    }

    public function connexion()
    {
        if ($this->request->existParam('post', 'connexion')) {
            $datasForm = $this->request->getParams('post');
            $connexion = new \App\Model\Connexion();
            $connexion->setUser($datasForm);
            if ($connexion->isValid()) {
                if ($connexion->connexion()) {
                    $this->request->getSession()->setAttribut('auth', $connexion->getUser());
                    $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                    header('Location: /');
                    exit();
                }
                $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                header('Location: /#connexion');
                exit();
            } else {
                $this->request->getSession()->setAttribut('connexionErrors', $connexion->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $connexion->getMessage());
                header('Location: /#connexion');
                exit();
            }
        }
        header('Location: /');
        exit();
    }

    public function deconnexion()
    {
        $this->request->getSession()->deconnexion();
        $this->request->getSession()->setAttribut('flash', array('success' => 'Vous avez été déconnecté.'));
        header('Location: /');
        exit();
    }

    public function lostpassword()
    {
        if ($this->request->existParam('post', 'lostpassword')) {
            $datasForm = $this->request->getParams('post');
            $recovery = new \App\Model\Recovery();
            $recovery->setUser($datasForm);
            if ($recovery->isValid()) {
                $recovery->recovery();
                $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('lostpasswordForm', $recovery->getUser());
                $this->request->getSession()->setAttribut('lostpasswordErrors', $recovery->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                header('Location: /home/lostpassword/#lostpassword');
                exit();
            }
            // on vérifie le formulaire
                // on traite le formulaire
                // on envoi le mail
                // on redirige vers home/
            // formulaire pas bon
                // message erreur
        }
        //$this->websiteConfig = new \App\Model\WebsiteConfig();
        //$this->book = new \App\Model\Book();
        //$config = $this->websiteConfig->getConfig();
        //$book = $this->book->getTheLastBook();
        $this->generateView(array(
            //'config' => $config,
            //'book' => $book
        ));
    }
}