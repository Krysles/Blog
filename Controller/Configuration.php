<?php

namespace App\Controller;

class Configuration extends \App\Core\Controller
{
    protected $readmin = \App\Model\User::ADMIN;
    protected $readmax = \App\Model\User::ADMIN;
    protected $updatemin = \App\Model\User::ADMIN;
    protected $updatemax = \App\Model\User::ADMIN;

    public function read()
    {
        $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
        header('Location: /');
        exit();
    }
    public function update()
    {
        if ($this->request->existParam('post', 'configuration')) {
            $datasForm = $this->request->getParams('post');
            $configurationManager = new \App\Model\ConfigurationManager();
            $configurationManager->setConfiguration($datasForm);
            if ($configurationManager->isValid()) {
                $configurationManager->update();
                $this->request->getSession()->setAttribut('flash', $configurationManager->getMessage());
                header('Location: /admin');
                exit();
            } else {
                $this->request->getSession()->setAttribut('configurationForm', $configurationManager->getConfiguration());
                $this->request->getSession()->setAttribut('configurationErrors', $configurationManager->getValidator()->getErrors());
                $this->request->getSession()->setAttribut('flash', $configurationManager->getMessage());
                header('Location: /admin');
                exit();
            }
        } else {
            $this->request->getSession()->setAttribut('flash', array('danger' => "Une erreur s'est produite."));
            header('Location: /');
            exit();
        }
    }
}





