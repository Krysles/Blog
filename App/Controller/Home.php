<?php
namespace App\Controller;

use App\Model\Controller;

class Home extends Controller
{
    public function index()
    {
        $params = 'Parametres';
        $this->generateView(array(
            'params' => $params
        ));
    }
}