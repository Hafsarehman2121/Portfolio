<!DOCTYPE html>
<html lang="en">

<?php
$notiForID=$bookSlotID= $bookStatus=$bookDate=$notiID="";
require ('includes/head.php');
$conID=$_SESSION['userID'];

if($_GET['notiID']){
  $notiID = $_GET['notiID'];
  $sql = "UPDATE `tbl_notifications` SET `noti_status` = '1' WHERE `noti_id` = '$notiID'";
  $result = mysqli_query($con,$sql);
  $sql1 = "SELECT * FROM `tbl_notifications`  WHERE `noti_id` = '$notiID'";
  $result1 = mysqli_query($con,$sql1);
  if (mysqli_num_rows($result1) == 1) {
      if ($row = mysqli_fetch_array($result1)) {
        $notiForID = $row['noti_forID'];
        
      }
}
 $sql="SELECT * FROM `tbl_bookappointment` WHERE `book_consID`='$notiForID'";
 $result = mysqli_query($con,$sql);
 if (mysqli_num_rows($result1) == 1) {
      if ($row = mysqli_fetch_array($result1)) {
       $bookSlotID=$row['book_slotID'];
       $bookStatus=$row['book_status'];
       $bookDate=$row['book_date'];

        
      }
    }
  }


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
  
    <div style="width: 50%; margin:auto;">
      <div class="col-md-12">
        <br>
        <h3 style="text-center">My Slots  <a href="schedule.php" style="width: 130px;" class="btn btn-sm btn-block btn-success float-right">Add New Slot</a></h3>
        
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
      </div>
    
        <div class="card-body">
          <ul class="list-group">
            
            <li class="list-group-item">
              <b>Name : </b> <span class="float-right"><?php echo $bookStatus; ?></span>
            </li>
            <li class="list-group-item">
              <b>CNIC : </b> <span class="float-right"><?php echo $bookDate; ?></span>
            </li>
           
            
          </ul>
        </div>
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
