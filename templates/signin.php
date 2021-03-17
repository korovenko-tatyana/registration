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
        </div>
    </div>
</header>
<div class="intro__login">
        <div class="intro__img"></div>
        <div class="form">
            <h2 style="color: #800032;">Регистрация</h2>
            <br>
            <div style="color: red"><?= $errors ?></div>
            <br>
            <form action="/registration/public/register" method="post">
                <label class="label">Nick</label>
                <input type="text" name="nickname">
                <br>
                <label class="label">Email</label>
                <input type="text" name="email">
                <br>
                <label class="label">Password</label>
                <input type="password" name="password">
                <br>
                <input class="btn__login" type="submit" value="Sign in">
            </form>
        </div>
</div>
</div>
</body>
</html>