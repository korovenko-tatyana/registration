<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/registration/src/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Playfair+Display&family=Yusei+Magic&display=swap" rel="stylesheet">
    <title>Eines Abends | Tests - Login</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="header__logo">
                <a class="header__link" href="/registration/public">
                    Eines Abends
                </a>
            </div>
            <nav class="nav">
                <?php
                $loginFromCookie = $_COOKIE['nickname'] ?? '';
                if ($loginFromCookie === ''): ?>
                    <a class="nav__link" href="/registration/public/login">Log in</a>
                    <a class="nav__link" href="/registration/public/register">Sign in</a>
                    <a class="nav__link" href="/registration/public/users">All users</a>
                <?php else: ?>
                    <a class="nav__link" href="/registration/public/profile/<?= $loginFromCookie?>">Hi, <span class="nick__weight"><?= $loginFromCookie?></span>!</a>
                    <a class="nav__link" href="/registration/public/logout">Log out</a>
                    <a class="nav__link" href="/registration/public/users">All users</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
<div class="widget">
    <div class="widget__container">
        <h3 class="account center__class">Users</h3>
        <ul class="widget-list">
            <?php foreach ($users as $user): ?>
            <li><a class="nav__link" href="/registration/public/profile/<?= $user['nickname']?>"><?= $user['nickname'] ?></a></li>   
<?php endforeach; ?>
</ul>
</div>
</div>
</body>
</html>