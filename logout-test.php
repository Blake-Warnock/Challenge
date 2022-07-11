<?php
session_start();
session_unset();
session_destroy();
setcookie("user", "", time() - 36000, "/");
header("location:index.php");
?>