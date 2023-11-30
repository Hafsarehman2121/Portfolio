<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
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
  
    <div style="width: 30%; margin:auto;">
      <br>
      <div class="col-md-12">
        <h3 style="text-align: center;">Consultants</h3>
      </div>
      <?php
       $sql = "SELECT * FROM `tbl_consultants`";
       $result = mysqli_query($con,$sql); 
       ?>
    <div class="col-md-12 ">
        <?php   
       while ($row = mysqli_fetch_array($result)) {
        ?>
      <div class="p-3 mb-2 .bg-dark.bg-gradient text-white" style="width: 400px; height:250px; background-color: #008080; text-align: center;">
          <div>
            <img src="img/user.jpg" style="width:70px; height: 70px; border-radius: 100px;">
          </div> 
          <div >
           <h3> <?php echo $row['cons_name']; ?></h3>
          </div>
          <div>
            <h5><i><?php echo getUserTitle($row['cons_type']); ?></i></h5>
          </div>
          <div>
            <h6>Experience: <?php echo $row['cons_exp']; ?></h6>
          </div>
          <div class="col-md-12 text-xs-center action-block"> 
              <a href="conSlots.php"> <button >Book Appointment</button></a>
         </div>
      </div>

     <?php
     }
     ?>


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
