<?php

namespace MyProject\Controllers;

use MyProject\Models\Users;
use MyProject\View\View;

class UsersController
{

    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp():void
    {
        if (!empty($_POST)) {
            \MyProject\Models\Users\User::signUp($_POST);
        }

        // \MyProject\Models\Users\User::signUp($_POST);
        //var_dump(\MyProject\Models\Users\User::findAll()); //подумать, почему var_dump внутри функции не работает

        //$user_test_2 = new \MyProject\Models\Users\User('tuzik', 'tuzik@umbrellait.com', 'tuziktuziktuzik');
        //echo ($user_test_2 -> getNickname());
        //$user_test_2 -> save();

        //include __DIR__ . '/../../../templates/signin.php';
        $this->view->renderTemplate('signin.php');

    }

    public function logIn():void
    {
        if (!empty($_POST)) {
            //echo \MyProject\Models\Users\User::findOneUser($_POST);

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
        $this->view->renderTemplate('login.php');
    }

    public function logOut():void
    {
        setcookie('nickname', '', -10, '/');
        setcookie('password', '', -10, '/');
        header('Location: /registration/public');
    }
}