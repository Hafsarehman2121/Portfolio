<?php 
session_start();
unset($_SESSION['adminID']);
unset($_SESSION['adminFullName']);

header("location:login.php");
exit();
?>