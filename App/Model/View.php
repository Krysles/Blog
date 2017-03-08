<?php

namespace App\Model;

class View
{
    private $file;
    private $title;

    public function __construct($action, $controller = "")
    {
        $file = "App/View/";
        if ($controller != "") {
            $file = $file . $controller . "/";
        }
        $this->file = $file . $action . ".php";
    }

    public function generate($dataView)
    {
        $content = $this->generateFile($this->file, $dataView);
        //$racineWeb = Configuration::get("racineWeb", "/");
        $view = $this->generateFile('App/View/template.php', array(
            'title' => $this->title,
            'content' => $content
            //'racineWeb' => $racineWeb
        ));
        echo $view;
    }

    public function generateFile($file, $dataView)
    {
        if (file_exists($file)) {
            extract($dataView);
            ob_start();
            require "$file";
            return ob_get_clean();
        } else {
            throw new \Exception("Fichier $file introuvable");
        }
    }

}