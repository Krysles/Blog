<?php
namespace App\Controller;

use App\Core\Controller;
use \App\Model\Book;
use \App\Model\Register;
use \App\Model\Connexion;
use \App\Model\Lostpassword;
use \App\Model\Recovery;

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
        $this->book = new Book();
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
            $register = new Register();
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
            $register = new Register();
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
            $connexion = new Connexion();
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
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth'])) { // A CHANGER EN OBJET
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        }
        if ($this->request->existParam('post', 'lostpassword')) {
            $datasForm = $this->request->getParams('post');
            $lostpassword = new Lostpassword();
            $lostpassword->setUser($datasForm);
            if ($lostpassword->isValid()) {
                $lostpassword->lostpassword();
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('lostpasswordForm', $lostpassword->getUser());
                $this->request->getSession()->setAttribut('lostpasswordErrors', $lostpassword->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /home/lostpassword/#lostpassword');
                exit();
            }
        }
        if ($this->request->existParam('get', 'token') && $this->request->existParam('get', 'id')) {
            $lostpassword = new Lostpassword();
            $id = $this->request->getParam('get', 'id');
            $token = $this->request->getParam('get', 'token');
            if ($lostpassword->isConfirmed($id, $token)) {
                $this->request->getSession()->setAttribut('recovery', $lostpassword->getLostpassword());
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /home/recovery');
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', $lostpassword->getMessage());
                header('Location: /');
                exit();
            }
        }
        $this->generateView();
    }
    
    public function recovery()
    {
        if (!$this->request->getSession()->existAttribut('recovery'))
        {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Vous n'avez pas les droits pour la page demandée."));
            header('Location: /');
            exit();
        } else {
            if ($this->request->existParam('post', 'recovery')) {
                $datasForm = $this->request->getParams('post');
                $recovery = new Recovery();
                $recovery->setUser($datasForm);
                if ($recovery->isValid()) {
                    $recovery->setUser($this->request->getSession()->getAttribut('recovery'));
                    $this->request->getSession()->deleteAttribut('recovery');
                    $recovery->recovery();
                    $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                    header('Location: /');
                    exit();
                } else {
                    $this->request->getSession()->setAttribut('recoveryErrors', $recovery->getValidator()->getErrors());
                    $this->request->getSession()->setAttribut('flash', $recovery->getMessage());
                    header('Location: /home/recovery#recovery');
                    exit();
                }
            }
        }
        $this->generateView();
    }
}