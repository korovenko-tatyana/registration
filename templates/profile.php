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
                $loginFromCookie = $_COOKIE['nickname'] ?? '';?>
                    <a class="nav__link" href="/registration/public/profile">Hi, <span class="nick__weight"><?= $loginFromCookie?></span>!</a>
                    <a class="nav__link" href="/registration/public/logout">Log out</a>
            </nav>
        </div>
    </div>
</header>
<div class="intro__login">
    <div class="intro__img"></div>
    <div class="user__info">
        <div class="account">Account</div>
        <br>
        <div class="user__nick_profile"><?= $_COOKIE['nickname']?></div>
        <br>
        <div class="user__info__email__days"><?= $emailUser ?></div>
        <div class="user__info__email__days"><?= $dayOfUser?> days</div>
        <br>
        <form action="/registration/public/profile" method="post">
        <input class="button_settings" type="submit" name="deleteUser" value="Delete account">
        </form>
        <?php
        if ($sureButton): ?>
        <div class="user__nick_profile"><?= $sureButton?></div>
        <br>
        <form action="/registration/public/profile" method="post">
            <input class="button_yesno" type="submit" name="yesDeleteUser" value="Yes">
            <input class="button_yesno" type="submit" name="noDeleteUser" value="No">
        </form>
        <?php endif; ?>
    </div>
</div>
</div>
</body>
</html>