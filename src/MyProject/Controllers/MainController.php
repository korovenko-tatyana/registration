<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;

use MyProject\View\View;

class MainController
{
    private $db;
    private $view;

    public function __construct()
    {
        $this->db = new Db();
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        //$users = $this->db->query('SELECT * FROM `users`;');
        //var_dump($users);

        //include __DIR__ . '/../../../templates/main.php';
        $this->view->renderTemplate('main.php');
    }

}