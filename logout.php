<?php
session_start();
unset($_SESSION['user_login']);
unset($_SESSION['username']);
// session_unset();
header('location:login.php');
die();
?>