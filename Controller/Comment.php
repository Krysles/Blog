<?php
namespace App\Controller;

use App\Core\Session;
use App\Model\Ticket;
use App\Model\User;

class Comment extends \App\Core\Controller
{
    protected $createmin = \App\Model\User::MEMBER;
    protected $createmax = \App\Model\User::ADMIN;
    protected $reportmin = \App\Model\User::MEMBER;
    protected $reportmax = \App\Model\User::ADMIN;
    protected $approvemin = \App\Model\User::ADMIN;
    protected $approvemax = \App\Model\User::ADMIN;
    protected $deletemin = \App\Model\User::ADMIN;
    protected $deletemax = \App\Model\User::ADMIN;

    public function read()
    {
        $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
        header('Location: /page');
        exit();
    }

    public function create()
    {
        if ($this->request->existParam('post', 'comment')) {
            $datasForm = $this->request->getParams('post');
            $commentManager = new \App\Model\CommentManager();
            $commentManager->setComment($datasForm);
            $commentManager->getComment()->setUser_id(Session::getSession()->getId());
            /*
                            echo '<pre>';
                            print_r($datasForm);
                            print_r($commentManager);
                            echo '</pre>';
            */

            if ($commentManager->isValid()) {
                $commentManager->insert();
                $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                header('Location: /episode/' . $commentManager->getComment()->getTicket_number());
                exit();
            } else {
                $this->request->getSession()->setAttribut('commentManagerForm', $commentManager->getComment());
                $this->request->getSession()->setAttribut('commentManagerErrors', $commentManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                header('Location: /episode/' . $commentManager->getComment()->getTicket_number());
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
        }
    }

    public function report()
    {
        if ($this->request->existParam('get', 'id')) {
            $commentid = $this->request->getParam('get', 'id');
            $commentManager = new \App\Model\CommentManager();
            if ($commentManager->getCommentFromBdd($commentid)) {
                $commentManager->getComment()->hydrate($commentManager->getCommentFromBdd($commentid));
                $commentManager->report();
                $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                header('Location: /episode/' . $commentManager->getComment()->getTicket_number());
                exit();
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Impossible de trouver le commentaire."));
                header('Location: /page');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
        }
    }
    
    public function approve()
    {
        if ($this->request->existParam('get', 'id')) {
            $commentid = $this->request->getParam('get', 'id');
            $commentManager = new \App\Model\CommentManager();
            if ($commentManager->getCommentFromBdd($commentid)) {
                $commentManager->getComment()->hydrate($commentManager->getCommentFromBdd($commentid));
                if($commentManager->isReport()) {
                    $commentManager->approve();
                    $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                    header('Location: /admin');
                    exit();
                } else {
                    $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                    header('Location: /admin');
                    exit();
                }
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Impossible de trouver le commentaire."));
                header('Location: /page');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
        }
    }
    public function delete()
    {
        if ($this->request->existParam('get', 'id')) {
            $commentid = $this->request->getParam('get', 'id');
            $commentManager = new \App\Model\CommentManager();
            if ($commentManager->getCommentFromBdd($commentid)) {
                $commentManager->getComment()->hydrate($commentManager->getCommentFromBdd($commentid));
                if($commentManager->isReport()) {
                    $commentManager->delete();
                    $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                    header('Location: /admin');
                    exit();
                } else {
                    $this->request->getSession()->setAttribut('flash', $commentManager->getMessage());
                    header('Location: /admin');
                    exit();
                }
            } else {
                $this->request->getSession()->setAttribut('flash', array('danger' => "Impossible de trouver le commentaire."));
                header('Location: /page');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /page');
            exit();
        }
    }
}
