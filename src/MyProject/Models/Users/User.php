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

    public static function profileInfo(string $nickname, &$profileEmail, &$profileData ):void
    {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $nickname]);
        if (!empty($result)){
            //$profileNick = $result[0]["nickname"];
            $profileEmail = $result[0]["email"];
            $profileData = $result[0]["created_at"];
        }
    }

    public static function registrationValidation (array $userData):string
    {
        if (empty($userData['nickname']) && empty($userData['email']) && empty($userData['password'])) {
            return "Fields Nick, Email and Password are empty";
        }
        if (empty($userData['nickname']) && empty($userData['email'])) {
            return "Fields Nick and Email are empty";
        }
        if (empty($userData['nickname']) && empty($userData['password'])) {
            return "Fields Nick and Password are empty";
        }
        if (empty($userData['email']) && empty($userData['password'])) {
            return "Fields Email and Password are empty";
        }
        if (empty($userData['nickname'])) {
            return "Field Nick is empty";
        }
        if (empty($userData['email'])) {
            return "Field Email is empty";
        }
        if (empty($userData['password'])) {
            return "Field Password is empty";
        }
        if (!preg_match('/^[\w\.]+@[\w]+\.[\w]+$/', $userData['email'],$matches, PREG_OFFSET_CAPTURE))
        {
            return "Wrong Email";
        }
        if (!preg_match('/^[\w\s\-]+$/', $userData['nickname'],$matches, PREG_OFFSET_CAPTURE))
        {
            return "Nick must consist of Latin letters, numbers, underscores and a space";
        }
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $userData['nickname']]);
        if (!empty($result)){
            return "Nick already exists";
        }
        $result = $db->query('SELECT * FROM `users` WHERE email = :email;', [':email' => $userData['email']]);
        if (!empty($result)){
            return "Email already exists";
        }
        return "Yes";
    }
}