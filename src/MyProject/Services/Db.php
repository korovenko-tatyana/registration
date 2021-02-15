<?php

namespace MyProject\Services;
use PDO;

class Db
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=127.0.0.1;dbname=my_test_db', 'root', 'QWE!qwe1', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $this->pdo->exec('SET NAMES UTF8');
    }

    /*public function queryy(): array
    {
        $sth = $this->pdo->prepare('SELECT * FROM `users`'); //подумать, что было не так с передачей параметра
        $sth->execute();
        return $sth->fetchAll();
    }*/

    public function query(string $sql, $params = []): array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }
}