<?php

namespace MyProject\Models\Users;

class User
{
    private $nickname;
    private $email;
    private $passwordHash;
    private $createdAt;

    public function __construct(string $nickname, string $email, string $passwordHash, string $createdAt)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->createdAt = $createdAt;
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

    public static function signUp(array $userData)
    {
        var_dump($userData);
    }
}