<?php

namespace MyProject\Models\Users;

use MyProject\Services;

class User
{
    private $nickname;
    private $email;
    private $passwordHash;
    //private $createdAt;

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

    public static function signUp(array $userData):User
    {
        $user = new User($userData['nickname'],$userData['email'],password_hash($userData['password'],PASSWORD_DEFAULT));
        $db = new \MyProject\Services\Db();
        $db->query('INSERT INTO `users`(`nickname`, `email`, `password_hash`) VALUES(:nickname, :email, :password_hash)', [':nickname' => $userData['nickname'], ':email' => $userData['email'], ':password_hash' => password_hash($userData['password'],PASSWORD_DEFAULT)]);
        return $user;
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