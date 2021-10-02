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
<div class="intro__login">
    <div class="intro__img"></div>
    <div class="user__info">
        <a class = "user__avatar__container" href="/registration/public/profile/settings">
        <img width="90" height="90" alt="" src="data:image/jpeg;base64,<?= $userAvatar?>">
        </a>
        <br>
        <div class="user__nick_profile"><?= $_COOKIE['nickname']?></div>
        <br>
        <button class="button_settings delete_button" type="button">Delete account</button>
            <div class="user__nick_profile sure_text not_vis_text">Are you sure you want to delete your account?</div>
            <br>
            <form action="/registration/public/profile/settings" method="post">
                <input class="button_yesno yes_vis not_vis_text" type="submit" name="yesDeleteUser" value="Yes">
                <input class="button_yesno no_vis not_vis_text" type="submit" name="noDeleteUser" value="No">

            </form>

        <button class="button_settings change_avatar_button" type="button">Change avatar</button>

        <form action="/registration/public/profile/settings" method="post" enctype="multipart/form-data">
            <input class="avatar_button file_button not_vis_text" type="file" name="myimage">
            <input class="avatar_button upload_button not_vis_text" type="submit" name="submit_image" value="Upload">
        </form>   
    </div>
</div>
</div>
<script>
    let sureButton = document.querySelector('.sure_text');
    let yesButton = document.querySelector('.yes_vis');
    let noButton = document.querySelector('.no_vis');
    let deleteButton = document.querySelector('.delete_button');

    let fileButton = document.querySelector('.file_button');
    let uploadButton = document.querySelector('.upload_button');
    let changeAvatarButton = document.querySelector('.change_avatar_button');


    deleteButton.onclick = function () {
        sureButton.classList.toggle('not_vis_text');
        yesButton.classList.toggle('not_vis_text');
        noButton.classList.toggle('not_vis_text');
    };

    changeAvatarButton.onclick = function () {
        fileButton.classList.toggle('not_vis_text');
        uploadButton.classList.toggle('not_vis_text');
    };

    uploadButton.onclick = function () {
        $('img').show();
    };
</script>
</body>
</html>