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
            //echo preg_match('/^[\w\.]+@[\w]+\.[\w]+$/', $_POST['email'],$matches, PREG_OFFSET_CAPTURE);
            $errorAboutValidationOfRegistration = \MyProject\Models\Users\User::registrationValidation($_POST);
            if ($errorAboutValidationOfRegistration === "Yes")
            {
                $user = \MyProject\Models\Users\User::signUp($_POST);
            } else
            {
                $this->view->renderHtml('signin.php', ['errors' => $errorAboutValidationOfRegistration]);
            }
        } else {
            $this->view->renderTemplate('signin.php');
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
            header("Location: $extra");
        }
        $this->view->renderHtml('login.php', ['error' => $error]);
    }

    public function logOut():void
    {
        setcookie('nickname', '', -10, '/');
        setcookie('password', '', -10, '/');
        header('Location: /registration/public');
    }
}