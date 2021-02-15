<?php
setcookie('login', '', -10, '/');
setcookie('password', '', -10, '/');
header('Location: /registration/templates/index.php');
?>