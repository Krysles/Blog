<?php
namespace App\Model;

use \App\Core\Database;

class ConfigurationManager extends Database
{
    private $configuration;
    private $validator;
    private $message = array();

    public function __construct() { $this->configuration = new \App\Model\Configuration(); }

    public function getValidator() { return $this->validator; }

    public function getMessage() { return $this->message; }

    public function setMessage($alert, $error) { $this->message[$alert] = $error; }

    public function getConfiguration() { return $this->configuration; }

    public function setConfiguration($configuration)
    {
        $this->configuration->hydrate($configuration);
    }

    public function isValid()
    {
        $this->validator = new \App\Validator\ValidateConfiguration();
        $this->validator->validTitle($this->configuration->getTitle());
        $this->validator->validSubtitle($this->configuration->getSubtitle());

        if (empty($this->validator->getErrors())) {
            return true;
        } else {
            $this->setMessage('danger', "Un problème a été rencontré lors de la modification de la configuration.");
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE configuration SET title = :title, subtitle = :subtitle WHERE id = :id";
        $this->runRequest($sql, array(
            ':title' => $this->configuration->getTitle(),
            ':subtitle' => $this->configuration->getSubtitle(),
            ':id' => 1
        ));

        $this->setMessage('success', "La configuration du site a bien été mis à jour.");
    }
    
    public function getConfig()
    {
        $sql = 'SELECT * FROM configuration';
        return $this->runRequest($sql)->fetch(\PDO::FETCH_ASSOC);
    }
}