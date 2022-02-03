<?php
session_start();
unset($_SESSION['admin_login']);
unset($_SESSION['username']);
header('location:adminlogin.php');
die();
?>