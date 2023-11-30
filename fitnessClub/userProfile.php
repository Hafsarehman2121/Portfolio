<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
 $whereClasue = "WHERE `cons_status` = 'A'";
$userName = $userImage=
$userEmail = $userNumber=" "; 
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


$conID= $_SESSION['userID'];
   $sql = "SELECT * FROM `tbl_user` WHERE `user_id` =  '$conID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $userName = $row['user_name'];
        $userNumber = $row['user_contactNo'];
        $userEmail = $row['user_email'];
        $userImage = $row['user_img'];

      }
    }
  }

  ?>
    




<!-- BLOG
    ================================================== -->

<section class="blog-sec" id="blog">
  <div class="container">
    <br>
    <div class="row">
      <br>
      <br>
      <div class="col-md-8" style="min-height: 200px;">
        <div>
          <h2>My Profile</h2>
        </div>
        <div class="blog-box">
          <div class="row">
            <div class="col-md-6">
              <div class="blog-image-block"> 
                <?php if($userImage != "" && file_exists($userImage)){
                  ?>
                  <img style="width:350px; height: 300px; margin-top: 20px;" src="<?php echo $userImage;?>" alt="" class="img-fluid">
                  <?php 
                }else{
                  ?>
                  <img style="width:350px; height: 300px; margin-top: 20px;" src="img/blog-01.jpg" alt="" class="img-fluid">
                  <?php
                } ?>
                
             </div>
            </div>
            

            <div  class="col-md-6" >
              <br>
              <table style="text-align:left;">
                <tr  >
                  <td style="font-size:20px; padding-bottom: 50px;" ><b>Name</b></td>
                  <td style="padding-bottom: 50px;"><b><?php echo $userName ?></b></td>
                </tr>
               
                <tr >
                  <td style="font-size:20px; padding-bottom: 50px;"><b>Contact Number</b></td>
                    <td style="padding-bottom: 50px;"><b><?php echo $userNumber?></b></td>
                  </tr>
                 
                  <tr >
                    <td style="font-size:20px; padding-bottom: 50px;"><b>Email Address</b></td>
                    <td style="padding-bottom: 50px;"><b><?php echo $userEmail ?></b></td>
                  </tr>
                 
                  <tr >
                    <td colspan="2">
                      <a href="editUserProfile.php?constID=<?php echo $conID; ?>;"  class="btn btn-sm btn-block btn-info">Edit Profile</a>
                    </td>
                  </tr>
                </table>
            </div>
          </div>

           

          
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
