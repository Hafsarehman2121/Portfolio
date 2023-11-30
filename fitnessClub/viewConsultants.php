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
 $consultantType =$consultantImage="";
  $heading = "All Consultants (Gym Trainers & Nutritionists)";
     $whereClasue = "WHERE `cons_status` = 'A'";
    if (isset($_GET['type'])) {
      $consultantType = $_GET['type'];
      $whereClasue .= " AND `cons_type` = '$consultantType'";

      if($consultantType == "GT"){
        $heading = "All Gym Trainers";
      }else if($consultantType == "N"){
        $heading = "All Nutritionists";
      }

    }
?>
    
<br><br>





<!-- BLOG
    ================================================== -->

<section class="blog-sec" id="blog">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
    <div class="heading text-md-center text-xs-center">
      <br>
      <h2 style="color:black; font-style: sans-serif;"><?php echo  $heading ; ?></h2>
      <div style="width: 30%; margin:auto" class="row">
        <a href="viewConsultants.php" class="ml-3 btn btn-sm btn-success mr-3">All</a>
        <a href="viewConsultants.php?type=GT" class="btn btn-sm btn-info mr-3">Gym Trainers</a>
        <a href="viewConsultants.php?type=N" class="btn btn-sm btn-primary mr-3">Nutritionists</a>
      </div>

    </div>
    </div>
    
    <div class="col-md-12">

    <?php if(isset($_SESSION['errorMsg'])){ ?>
      <div class="alert alert-danger">
        <?php echo $_SESSION['errorMsg'];  
              unset($_SESSION['errorMsg']); ?>
      </div>
      <?php } ?>
      </div>

    <?php
   
       $sql = "SELECT * FROM `tbl_consultants` ".$whereClasue." ORDER BY `cons_id` DESC";

       $result = mysqli_query($con,$sql); 
       if($result){
        if (mysqli_num_rows($result)>0) {
          while ($row = mysqli_fetch_array($result)) {
             $consultantImage = $row['cons_img'];
          
       ?>
      <div class="col-md-3 blog-box mb-3" >
         <?php if($consultantImage != "" && file_exists($consultantImage)){
            ?>
            <div class="blog-image-block"><img style="width:300px; height: 180px; margin-top: 20px;" src="<?php echo $consultantImage; ?>" alt="" class="img-fluid"></div>
            <?php 
          }else{
            ?>
        <div class="blog-image-block"> <img style="width:300px; height: 180px; margin-top: 20px;" src="img/user1.jpg" alt="" class="img-fluid"> </div>
         <?php
          } ?>
        <h3 class="blog-title"><small><?php echo $row['cons_name']; ?><span> <?php if(getOverAllRating($row['cons_id'])>0){ echo getOverAllRating($row['cons_id']); }else{echo "N/A";} ?> <i class="fa fa-star" style="color:yellow;" aria-hidden="true"></i></span></small>
<a href="javascript:;"><?php echo getUserTitle($row['cons_type']); ?></a></h3>
        <p class="blog-content"><a href="javascript:;">Our greatest happiness does not depend o....</a></p>

        <div class="row">
          <div class="col-md-6">
            <a href="conDetails.php?constID=<?php echo $row['cons_id']; ?>" style="width: 130px;" class="btn btn-sm btn-block btn-primary">View Details</a>
            
          </div>
          <div class="col-md-6">
           
            <a href="javascript:;" style="width: 130px;" class="btn btn-sm btn-block btn-success">Book Appointment</a>
          </div>
        </div>

      </div>
    <?php 
      } 
      }else{
        ?>
        <div class="alert alert-info">No Consultant(s) Found</div>
        <?php
      }
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
