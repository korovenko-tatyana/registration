<?php

namespace MyProject\Models\Users;

use MyProject\Services;

class User
{
    private $nickname;
    private $email;
    private $passwordHash;
    private $avatar;
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

    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public static function signUp(array $userData):User
    {
        $user = new User($userData['nickname'],$userData['email'],password_hash($userData['password'],PASSWORD_DEFAULT));
        $db = new \MyProject\Services\Db();
        $default_user_avatar = base64_encode(file_get_contents('../src/css/images/avatar_user.jpeg', FILE_USE_INCLUDE_PATH));
        $db->query('INSERT INTO `users`(`nickname`, `email`, `password_hash`, `user_avatar`) VALUES(:nickname, :email, :password_hash, :user_avatar)', [':nickname' => $userData['nickname'], ':email' => $userData['email'], ':password_hash' => password_hash($userData['password'],PASSWORD_DEFAULT), ':user_avatar' => $default_user_avatar]);
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

    public static function findAllUsers(): array
    {
        $db = new \MyProject\Services\Db();
        return $db->query('SELECT * FROM `users`;', [], User::class);
    }

    public static function profileInfo(string $nickname, &$profileEmail, &$profileData, &$profileAvatar ):void
    {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $nickname]);
        if (!empty($result)){
            //$profileNick = $result[0]["nickname"];
            $profileEmail = $result[0]["email"];
            $profileData = $result[0]["created_at"];
            $profileAvatar = $result[0]["user_avatar"];
        }
    }
//info about user using Id (not using nickname)

/*
    public static function profileInfoId(int $userId, &$profileNickname, &$profileEmail, &$profileData, &$profileAvatar ):void
    {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE id = :id;', [':id' => $userId]);
        if (!empty($result)){
            $profileNickname = $result[0]["nickname"];
            $profileEmail = $result[0]["email"];
            $profileData = $result[0]["created_at"];
            $profileAvatar = $result[0]["user_avatar"];
        }
    }
*/
    public static function deleteUser(string $nickname) {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $nickname]);
        if (!empty($result)) {
            $db->query('DELETE FROM `users` WHERE nickname = :nickname;', [':nickname' => $nickname]);
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

    public static function changeAvatar (string $nickname, string $name_of_img) {
        $db = new \MyProject\Services\Db();
        $result = $db->query('SELECT * FROM `users` WHERE nickname = :nickname;', [':nickname' => $nickname]);
        if (!empty($result)){
            $new_user_avatar = base64_encode(file_get_contents($name_of_img));
            $db->query('UPDATE `users` SET `user_avatar`= :new_user_avatar WHERE nickname = :nickname;', [':new_user_avatar' => $new_user_avatar, ':nickname' => $nickname]);
        }
    }

    //if you need to add new column to db with values. On this function addAvatarDafault: I add default avatar to all users on db. This function I use only one time, because to new users I change function signUp
   
    /* public static function addAvatarDafault(string $user_dafault_avatar)
    {
        //$user = new User($userData['nickname'],$userData['email'],password_hash($userData['password'],PASSWORD_DEFAULT));
        $db = new \MyProject\Services\Db();
        $db->query('UPDATE `users` SET `user_avatar`= :user_dafault_avatar', [':user_dafault_avatar' => $user_dafault_avatar]);
        //return $user;
    }*/
}