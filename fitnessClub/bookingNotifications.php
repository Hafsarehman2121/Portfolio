<!DOCTYPE html>
<html lang="en">

<?php

require ('includes/head.php');
$conID=$_SESSION['userID'];
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
        <h3 style="text-center"> Notifications</h3>
        
      </div>
      
      <br>
      <div class="col-md-12">
       

        <table class="table table-striped table-dark">
           <thead>
                  <?php 

      $i=1;
       $sqlNoti = "SELECT * FROM `tbl_notifications` WHERE `noti_status` = '0' AND  `noti_for` = 'GT'  ORDER BY `noti_id` AND `noti_forID` = '$conID'"; 

      $resultNoti = mysqli_query($con,$sqlNoti);
      $totNoti = mysqli_num_rows($resultNoti);
            ?>
          
    <tr>
      <th scope="col">#</th>
      <th scope="col">Notifications</th>
      
  
    </tr>
  </thead>
  <tbody>
    
     <?php   
       while ($rowNoti = mysqli_fetch_array($resultNoti)) {
            
              $notiUrl = "editAppointments.php?consID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
           
        ?>
    <tr>
      <td> <?php echo $i; ?></td>
      <td> <a style="color: white; " href="<?php echo $notiUrl; ?>"    
              <i class="fas fa-envelope mr-2"></i> <?php echo $rowNoti['noti_title']; ?>

            </a></td>
      
    </tr>
  <?php
  $i++;
}
?>
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
