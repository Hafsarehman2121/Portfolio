<?php
session_start();
$con = mysqli_connect('localhost','root','');
$db = mysqli_select_db($con,'fitness_club_db');


if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
?>