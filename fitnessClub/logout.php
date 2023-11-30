<?php
require 'includes/connection.php';
if (session_start())
{
	          unset($_SESSION['userID']);
              unset($_SESSION['userFullName']);
              unset($_SESSION['userType']) ;

              header("location:userLogIn.php");
              exit();
}
?>