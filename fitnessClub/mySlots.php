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
        <?php
        $sql = "SELECT * FROM `tbl_slot`  WHERE `consID`= '$conID' ";
        $result = mysqli_query($con,$sql); 
        if($result){
          if (mysqli_num_rows($result)>0) {
            ?>

        <table class="table table-striped table-dark">
           <thead>
                <tr>
                  <th scope="col">Slot ID</th>
                  <th scope="col">Day</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Status</th>

                  <th scope="col">Details</th>
                </tr>
           </thead>
           <?php   
           $srNo = 1;
       while ($row = mysqli_fetch_array($result)) {
        ?>
         <tbody>
          <tr>
            <th scope="row"><?php echo $srNo ; ?></th>
            <td><?php echo getDayName($row['slot_day']); ?></td>
            <td><?php echo $row['slot_Stime']; ?></td>
            <td><?php echo $row['slot_Etime']; ?></td>
            <td><?php echo slotStatusTitle($row['slot_status']); ?></td>

            <td><a href="editSlot.php?slotID=<?php echo $row['slot_id']; ?>" class="btn btn-sm btn-success ">Edit</a>
              <a href="" class="btn btn-sm btn-danger ">Delete</a>
            </td>
          </tr>
          
        </tbody>
      <?php
      $srNo ++;
    }

          }else{
            ?>
            <div class="alert alert-info">No Slots Available.</div>
            <?php
          }
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
