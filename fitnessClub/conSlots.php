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
        <h3 style="text-center">My Slots</h3>
        
      </div>
      
      <br>
      <div class="col-md-12">
        <?php
        $sql = "SELECT * FROM `tbl_slot`  WHERE `consID`= '$conID' ";
        $result = mysqli_query($con,$sql); 
        ?>
        
        <table class="table table-striped table-dark">
           <thead>
                <tr>
                  <th scope="col">Slot ID</th>
                  <th scope="col">Day</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Details</th>
                </tr>
           </thead>
           <?php   
       while ($row = mysqli_fetch_array($result)) {
        ?>
         <tbody>
          <tr>
            <th scope="row"><?php echo $row['slot_id']; ?></th>
            <td><?php echo $row['slot_day']; ?></td>
            <td><?php echo $row['slot_Stime']; ?></td>
            <td><?php echo $row['slot_Etime']; ?></td>
            
          </tr>
          
        </tbody>
      <?php
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
