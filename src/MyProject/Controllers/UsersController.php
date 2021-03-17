<?php

namespace MyProject\Controllers;

use MyProject\Models\Users;
use MyProject\View\View;

class UsersController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function signUp():void
    {
        if (!empty($_POST)) {
            $errorAboutValidationOfRegistration = \MyProject\Models\Users\User::registrationValidation($_POST);
            if ($errorAboutValidationOfRegistration === "Yes")
            {
                $user = \MyProject\Models\Users\User::signUp($_POST);
                $login = $_POST['nickname'] ?? '';
                $password = $_POST['password'] ?? '';
                setcookie('nickname', $login, 0, '/');
                setcookie('password', $password, 0, '/');
                //$this->view->renderTemplate('main.php');
                header("Location: /../registration/public");
            } else
            {
                $this->view->renderHtml('signin.php', ['errors' => $errorAboutValidationOfRegistration]);
            }
        } else {
            $this->view->renderTemplate('signin.php');
        }
        if ($_COOKIE['nickname']) {
            header("Location: /../registration/public");
        }
    }

    public function logIn():void
    {
        //$error = false;
        if (!empty($_POST)) {
            $login = $_POST['nickname'] ?? '';
            $password = $_POST['password'] ?? '';
            $extra = '/../registration/public';

            if (\MyProject\Models\Users\User::findOneUser($_POST)) {
                setcookie('nickname', $login, 0, '/');
                setcookie('password', $password, 0, '/');
                header("Location: $extra");
            } else {
                $error = 'Ошибка авторизации';
            }
        }
        $loginFromCookie = $_COOKIE['nickname'] ?? '';
        if ($loginFromCookie !== '') {
            header("Location: /../registration/public");
        }
        $this->view->renderHtml('login.php', ['error' => $error]);
    }

    public function logOut():void
    {
        setcookie('nickname', '', -10, '/');
        setcookie('password', '', -10, '/');
        header('Location: /registration/public');
    }

    public function profileInfo():void
    {
        \MyProject\Models\Users\User::profileInfo($_COOKIE['nickname'],$profileEmail,$profileData);
        $this->view->renderHtml('profile.php', ['emailUser' => $profileEmail, 'dayOfUser' => ceil((time()-strtotime($profileData))/60/60/24)]);
    }
}