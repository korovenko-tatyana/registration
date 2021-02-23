<?php
setcookie('nickname', '', -10, '/');
setcookie('password', '', -10, '/');
header('Location: /registration/public');
?>