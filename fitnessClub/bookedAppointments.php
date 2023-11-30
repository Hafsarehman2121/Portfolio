<!DOCTYPE html>
<html lang="en">

<?php
$slotID= $slotStime = $slotEtime= $slotDay = $userName = 
$userNumber= $patientID= $status="";
require ('includes/head.php');
$userID=$_SESSION['userID'];
?>
<body>

<div class="loader loader-bg">
  <div class="loader-inner ball-clip-rotate-pulse">
    <div></div>
    <div></div>
  </div>
</div>

<?php
require ('includes/topNav.php'); 
?>
    



<!-- About 
    ================================================== -->
<section class="about-sec parallax-section" id="about">
  
    <div style="width: 70%; margin:auto;">
      <div class="col-md-12">
        <br>
        <h3 style="text-center">My Appointments</h3>
        
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
                  <th scope="col">Patient Name</th>
                  <th scope="col">Patient Contact</th>
                  <th scope="col">Day</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Status</th>
                  <th scope="col">Details</th>
                 
                </tr>
           </thead>
      <?php 
     
         $sql = "SELECT * FROM `tbl_bookappointment`  WHERE `book_consID`= '$userID' AND
         `book_status` = 'BK' ";
            $result = mysqli_query($con,$sql); 
            if($result){
              if (mysqli_num_rows($result)>0) {

              while ($row = mysqli_fetch_array($result)) {
             $patientID= $row['book_userID'];
             $slotID=$row['book_slotID'];
             $status = $row['book_status'];
           
       ?>
         <tbody>
          <tr>
            <?php
             $sql = "SELECT * FROM `tbl_user`  WHERE `user_id`= '$patientID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
               if (mysqli_num_rows($result)>0) {

              while ($row1 = mysqli_fetch_array($result)) {
                 $userName=$row1['user_name'];
                 $userNumber=$row1['user_contactNo'];
              
           ?>
            <td scope="row"><?php echo $userName ; ?></td>
            <td scope="row"><?php echo $userNumber ; ?></td>
            
             <?php
           }
         }
       }
             
            $sql = "SELECT * FROM `tbl_slot`  WHERE `slot_id`= '$slotID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
               if (mysqli_num_rows($result)>0) {

              while ($row2 = mysqli_fetch_array($result)) {
                 $slotStime=$row2['slot_Stime'];
                 $slotEtime=$row2['slot_Etime'];
                 $slotDay = $row2['slot_day'];
              
          ?>
            <td><?php echo getDayName($slotDay) ?></td>
            <td><?php echo $slotStime; ?></td>
            <td><?php echo $slotEtime; ?></td>
            <td><?php echo slotStatusTitle($status); ?></td>
            <td><a href="showUserProfile.php?consultantID=<?php echo $userID ?>&clientID=<?php echo $patientID ?>"><button type="button" class="btn btn-primary"><span class="fa fa-comments-o"></span> Chat <?php if (getChatNotifications($patientID,$userID) > 0 ) { ?>
                                             <span class="badge badge-light"><?php echo getChatNotifications($patientID,$userID); ?>
                                             </span><?php } ?> </button></a></td>

            
          </tr>

         <?php      
            }
            }
          }
        }
      }
    }
         
          
          ?>
          
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
