<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php
require ('includes/head.php');
require ('includes/topNav.php'); 

$bookTitle = $bookDesc = $bookDate = $slotDay =  $slotStime = $bookingUserID =
$slotEtime = $bookStatus= $userName = $userContact ="" ;
if(isset($_GET['bookingID'])){
  $bookId = $_GET['bookingID'];
  }
$userID = $_SESSION['userID'];

?>

<body>
<?php
          $sql= "SELECT `tbl_consultants`.*,`tbl_user`.`user_name`,`tbl_user`.`user_email`,`tbl_user`.`user_contactNo`,`tbl_bookappointment`.`book_id`,`tbl_bookappointment`.`book_userID`,`tbl_bookappointment`.`book_consID`,`tbl_bookappointment`.`book_slotID`,`tbl_bookappointment`.`book_title`,`tbl_bookappointment`.`book_desc`,`tbl_bookappointment`.`book_status`,`tbl_bookappointment`.`book_date`,`tbl_slot`.* FROM `tbl_bookappointment`
                           INNER JOIN `tbl_user` ON `tbl_bookappointment`.`book_userID` = `tbl_user`.`user_id`
                           INNER JOIN `tbl_consultants` ON `tbl_bookappointment`.`book_consID` = `tbl_consultants`.`cons_id`
                           INNER JOIN `tbl_slot` ON `tbl_bookappointment`.`book_slotID` = `tbl_slot`.`slot_id`
                           WHERE `tbl_bookappointment`.`book_id` = '$bookId'";
                          $result = mysqli_query($con,$sql);
                    if ($result) {
                    if (mysqli_num_rows($result) == 1) {
                      if ($row = mysqli_fetch_array($result)) {
                        $bookTitle = $row['book_title'];
                        $bookDesc = $row['book_desc'];
                        $bookDate = $row['book_date'];
                        $slotDay = $row['slot_day'];
                        $slotStime = $row['slot_Stime'];
                        $slotEtime = $row['slot_Etime'];
                        $bookStatus= $row['book_status'];
                        $userName = $row['user_name'];
                        $userContact = $row['user_contactNo'];
                        $bookingUserID  = $row['book_userID'];
                      }

                    }
                  }


if(isset($_GET['bookingID']) && isset($_GET['status'])){
  $bookID = $_GET['bookingID'];
  $status = $_GET['status'];

  $sql = "UPDATE `tbl_bookappointment` SET `book_status` = '$status' WHERE `book_id` = '$bookID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
      $bookingID = $bookID;//mysqli_insert_id($con);
      if($status == "BK"){
        $notiTitle = "Your Appointment has been Booked. ";
        
      }else if($status == "C"){
        $notiTitle = "Your Appointment has been Cancelled.";
      }
      $notiFor = "U";
      $notiForID = $bookingUserID;
      $notiStatus = "0";
      $notiType = "B";
      $notiTypeID = $bookingID;
      $notiDate = date("Y-m-d h:i:s");
      $sql = "INSERT INTO `tbl_notifications` (`noti_title`,`noti_for`,`noti_forID`,`noti_type`,`noti_typeID`,`noti_date`,`noti_status`) VALUES ('$notiTitle','$notiFor','$notiForID','$notiType','$notiTypeID','$notiDate','$notiStatus')";
      
      $result = mysqli_query($con,$sql);
      if($result){
         // $_SESSION['successMsg'] = "Notification has been sent to user.";
         // header("location:bookingDetails.php?bookingID=".$bookId);
         // exit();

      $_SESSION['successMsg'] = "Appointment Status Has been Updated Successfully";
      header("location:bookingDetails.php?bookingID=".$bookId);
      exit();

}

  }
   
  }


if(isset($_GET['notiID'])){
  $notiID = $_GET['notiID'];
  $sql = "UPDATE `tbl_notifications` SET `noti_status` = '1' WHERE `noti_id` = '$notiID'";
  $result = mysqli_query($con,$sql);
} 
?>
<div class="loader loader-bg">
  <div class="loader-inner ball-clip-rotate-pulse">
    <div></div>
    <div></div>
  </div>
</div>


    



<!-- About 
    ================================================== -->
<section class="about-sec parallax-section" id="about">
  
    <div style="width: 80%; margin:auto;">
      <div class="col-md-12">
        <br>
        <h3 style="text-center">Appointment Details</h3>
        <?php 
              if($bookStatus == "C"){
                ?>
                <a href="bookingDetails.php?bookingID=<?php echo $bookId; ?>&status=BK" class="btn btn-sm btn-danger float-right">Accept Request</a>
                <?php
              }else if($bookStatus == "BK"){
                ?>
                <a href="bookingDetails.php?bookingID=<?php echo $bookId; ?>&status=C" class="btn btn-sm btn-success float-right">Cancel</a>

                <?php
              }else if($bookStatus == "P"){
                ?>
                <a href="bookingDetails.php?bookingID=<?php echo $bookId; ?>&status=BK" class="btn btn-sm btn-success float-right">Accept Request</a>
                <a href="bookingDetails.php?bookingID=<?php echo $bookId; ?>&status=C" class="btn btn-sm btn-danger float-right">Reject Request</a>
                <?php
              }
              ?>     
        
      </div>
      
      <br>
      <div class="col-md-12">
        <?php if(isset($_SESSION['errorMsg'])){
          ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg']); ?>
          </div>
          <?php
        } ?>

        <?php if(isset($_SESSION['successMsg'])){
          ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']); ?>
          </div>
          <?php
        } ?>
        <?php


     
        ?>

        <table class="table table-striped table-dark">
           <thead>
                <tr>
                  <th scope="col">Booking Title</th>

                  <th scope="col"> Booking Date</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Status</th>
                  <th scope="col">Description</th>
                   <th scope="col">Booked BY</th>
                    <th scope="col">Patient Number</th>

                 
                </tr>
           </thead>
      
         <tbody>
          <tr>
            
            <td scope="row"><?php echo $bookTitle ; ?></td>
            <td scope="row"><?php echo $bookDate ; ?></td>
             
            <td scope="row"><?php echo $slotStime ; ?></td>
            <td scope="row"><?php echo $slotEtime ; ?></td>
            <td scope="row"><?php echo slotStatusTitle($bookStatus) ; ?></td>
            <td scope="row"><?php echo $bookDesc ; ?></td>
            <td scope="row"><?php echo $userName ; ?></td>
            <td scope="row"><?php echo $userContact ; ?></td>
            
            

            
          </tr>
          
        </tbody>
   
</table>
      </div>
    
  </div>
</section>


<?php
require ('includes/footer.php'); 
?>


<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery.min.js" ></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/scrollPosStyler.js"></script> 
<script src="js/swiper.min.js"></script> 
<script src="js/isotope.min.js"></script> 
<script src="js/nivo-lightbox.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/core.js"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
