<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
 $whereClasue = "WHERE `cons_status` = 'A'";
$consultantName = $consultantExp = $consultantDesc= $consultantType=
$consultantEmail = $consultantNumber=" "; 
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

$constID = "";
if (isset($_GET['constID'])) {
  
  $constID = $_GET['constID'];
   $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_id` =  '$constID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $consultantName = $row['cons_name'];
        $consultantExp = $row['cons_exp'];
        $consultantDesc = $row['cons_desc'];
        $consultantType = $row['cons_type'];
        $consultantNumber = $row['cons_contactNo'];
        $consultantEmail = $row['cons_email'];
        $consultantImage = $row['cons_img'];

        
      }
    }
} 
    /*$sql="SELECT * FROM `tbl_slot` WHERE `cons_id` =  '$constID' AND 'slot_day'='M'";
    $result = mysqli_query($con,$sql);
        if ($result) {
          if (mysqli_num_rows($result) >0) {
            while ($row = mysqli_fetch_array($result)) {
              $Stime = $row['slot_Stime'];
              $Etime = $row['slot_Etime'];
            }
          }
            }*/
}else{
  $_SESSION['errorMsg'] = "Access Denied..!";
  
  exit();
}
?>
    




<!-- BLOG
    ================================================== -->
<br>
<br>
<section class="blog-sec" id="blog">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
         <div class="">
               <h2>My Profile<h2>
          </div>
    </div>
    
      <div class="col-md-3 blog-box">
        <div class="blog-image-block"> 
          <?php if($consultantImage != "" && file_exists($consultantImage)){
            ?>
            <img style="width:500px; height: 300px; margin-top: 20px;" src="<?php echo $consultantImage; ?>" alt="" class="img-fluid">
            <?php 
          }else{
            ?>
            <img style="width:500px; height: 300px; margin-top: 20px;" src="img/blog-01.jpg" alt="" class="img-fluid">
            <?php
          } ?>
          
           </div>
        
      </div>
      <table>
      <tr >
              <td style="font-size:20px;" ><b>Name</b></td>
              <td ><b><?php echo $consultantName ?></b></td>
        </tr>
        
      <tr>
          
              <td style="font-size:20px;"><b>Speciality</b></td>
              <td><b><?php echo getUserTitle($consultantType) ?></b></td>
        </tr>
      
      <tr>
          
              <td style="font-size:20px;"><b>Experience</b></td>
              <td><b><?php echo $consultantExp ?></b></td>
        </tr>
      <tr>
          
              <td style="font-size:20px;"><b>Contact Number</b></td>
              <td><b><?php echo $consultantNumber?></b></td>
        </tr>

      <tr>
          
              <td style="font-size:20px;"><b>Email Address</b></td>
              <td><b><?php echo $consultantEmail ?></b></td>
        </tr>
      <tr>
          
              <td style="font-size:20px;"><b>Description</b></td>
              <td><b><?php echo $consultantDesc ?></b></td>
        </tr>
    </table>

    </div>
      <div  class="row">
  
            <a href="editProfile.php?constID=<?php echo $conID; ?>;" style="width: 300px; margin-left: 280px; font-size: 20px; " class="btn btn-sm btn-block btn-info">Edit Profile</a>
           
     </div>
     <br>
     
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
