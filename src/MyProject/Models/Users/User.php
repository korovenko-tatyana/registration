<?php

namespace MyProject\Models\Users;

use MyProject\Services;

class User
{
    private $nickname;
    private $email;
    private $passwordHash;
    private $createdAt;

    public function __construct(string $nickname, string $email, string $passwordHash)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        //$this->createdAt = $createdAt;
    }

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPasswordHash(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /*public static function findAll(): array
    {
        $db = new \MyProject\Services\Db();
        $str = 'SELECT * FROM `users`';
        return $db->query($str, []);
    }

    public function save(): void
    {
        $nameOfColumnsDb[0] = '`nickname`';
        $nameOfColumnsDb[1] = '`email`';
        $nameOfColumnsDb[2] = '`password_hash`';
        $tableName = $this -> getTableName();
        //$sqlReq = 'INSERT INTO' . ' ' . '`' . $tableName . '`' . ' ' . '(' . ' ' . implode(', ', $nameOfColumnsDb) . ' ' . ')' . ' VALUES ' . '(' . '\'' . $this -> getNickname() . '\'' . ', ' . '\'' . $this -> getEmail() . '\'' . ', ' . '\'' . $this -> getPasswordHash() . '\'' . ')' . ';';
        //$sqlReq1 = 'INSERT INTO ' . $tableName . ' ( ' . implode(', ', $nameOfColumnsDb) . ' ) VALUES (' . $this -> getNickname() . ', ' . $this -> getEmail() . ', ' . $this -> getPasswordHash() . ')';
        //$sqlReq12 = "INSERT INTO `users`(`nickname`, `email`, `password_hash`) VALUES(:nickname, :email, :password_hash)";

        $db = new \MyProject\Services\Db();
        //$db->query($sqlReq12, [':nickname' => 'anna', ':email' => 'anna@gmail.com', ':password_hash' => 'red']);
        $db->query('INSERT INTO `users`(`nickname`, `email`, `password_hash`) VALUES(:nickname, :email, :password_hash)', [':nickname' => $this -> getNickname(), ':email' => $this -> getEmail(), ':password_hash' => $this -> getPasswordHash()]);
    }

    protected static function getTableName(): string
    {
        return 'users';
    }*/

    public static function signUp(array $userData):void
    {
        $db = new \MyProject\Services\Db();
        $db->query('INSERT INTO `users`(`nickname`, `email`, `password_hash`) VALUES(:nickname, :email, :password_hash)', [':nickname' => $userData['nickname'], ':email' => $userData['email'], ':password_hash' => password_hash($userData['password'],PASSWORD_DEFAULT)]);
    }

    public static function findOneUser(array $userData):bool
    {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $userData['nickname']]);
        if (!empty($result)){
            if (password_verify($userData['password'], $result[0]["password_hash"]))
            return true;
        }
        return false;
    }


}