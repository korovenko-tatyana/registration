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

    public function query(string $sql): array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute();
        return $sth->fetchAll();
    }
}