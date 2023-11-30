<!DOCTYPE html>
<html lang="en">

<?php
$bookID = $patientName = $bookSlot = $bookStatus = $bookDate ="";
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
        <h3 style="text-center">My Slots  <a href="schedule.php" style="width: 130px;" class="btn btn-sm btn-block btn-success float-right">Add New Slot</a></h3>
        
      </div>
      
      <br>
      <div class="col-md-12">
      
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
