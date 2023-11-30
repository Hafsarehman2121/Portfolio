<?php
require 'includes/connection.php';
require 'includes/functions.php';


  $userID = $_SESSION['userID'];
  $consID = $_POST['consID'];
  $rating = $_POST['rating'];
  
  $bookingID = $_POST['bookingID'];


  $sql = "SELECT * FROM `tbl_ratings` WHERE `rating_consID` = '$consID' AND `rating_userID` = '$userID' AND `rating_bookingID` = '$bookingID'" ;
  $result = mysqli_query($con,$sql);
  if ($result) {
    $date = date("Y-m-d h:i:s");
    if (mysqli_num_rows($result) == 0) {
      $sql = "INSERT INTO `tbl_ratings` (`rating_stars`,`rating_bookingID`,`rating_consID`,`rating_userID`,`rating_date`) VALUES ('$rating','$bookingID','$consID','$userID','$date') ";
      $result= mysqli_query($con,$sql);
      if ($result) {
        // echo "ok";
        echo ratingAgainstBookingID($bookingID);
      }
    }else{
      $sql = "UPDATE `tbl_ratings` SET `rating_stars` = '$rating' WHERE `rating_consID` = '$consID' AND `rating_userID` = '$userID' AND `rating_bookingID` = '$bookingID' ";
  $result= mysqli_query($con,$sql);
  if ($result) {
    // echo "ok";
    echo ratingAgainstBookingID($bookingID);
  }
    }
  }

  
?>