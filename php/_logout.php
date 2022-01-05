<?php
session_start();
session_destroy();
setcookie('username_c','', time() + (86400 * 30), "/");
setcookie('password_c','', time() + (86400 * 30), "/");
header("location: ../login.php");
?>