<?php
namespace App\Controller;

use App\Core\Controller;

class Contact extends Controller
{
    public function read()
    {
        if ($this->request->existParam('post', 'contact')) {
            $datasForm = $this->request->getParams('post');
            $contact = new \App\Model\Contact();
            $contact->setContact($datasForm);
            if ($contact->isValid()) {
                $contact->send();
                $this->request->getSession()->setAttribut('flash', $contact->getMessage());
                header('Location: /');
                exit();
            } else {
                $this->request->getSession()->setAttribut('contactForm', $contact->getContact());
                $this->request->getSession()->setAttribut('contactErrors', $contact->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $contact->getMessage());
                header('Location: /#contact');
                exit();
            }
        }
        header('Location: /');
        exit();
    }
}