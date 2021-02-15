<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;

class MainController
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function main()
    {
        //$users = $this->db->query('SELECT * FROM `users`;');
        //var_dump($users);
        include __DIR__ . '/../../../templates/main.php';
    }

}