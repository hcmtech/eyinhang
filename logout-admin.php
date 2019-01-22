<?php include 'controllers/authController.php';

session_destroy();
unset($_SESSION['email']);
unset($_SESSION['verified']);
header("location: login-admin.php");
?>