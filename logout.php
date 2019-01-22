<?php include 'controllers/authController.php';

session_destroy();
unset($_SESSION['UserID']);
unset($_SESSION['username']);
unset($_SESSION['userprenom']);
unset($_SESSION['adresse']);
unset($_SESSION['ville']);
unset($_SESSION['codepostale']);
unset($_SESSION['numerotel']);
unset($_SESSION['email']);
unset($_SESSION['verified']);
unset($_SESSION['typeuser']);
header("location: login.php");
?>