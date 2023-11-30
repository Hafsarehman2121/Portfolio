<?php 
require ('includes/head.php'); 
$userName = $userEmail = $userPass =  $userNo = "";
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
if(isset($_POST['regBtn'])){
  if(empty($_POST['userName'])){
       array_push($_SESSION['errors'], "User Name is Required.");
    }else{
      $userName = mysqli_real_escape_string($con,$_POST['userName']); 
    }

  if(empty($_POST['userEmail'])){
       array_push($_SESSION['errors'], "User Email is Required.");
    }else{
      $userEmail = mysqli_real_escape_string($con,$_POST['userEmail']); 
    }

  if(empty($_POST['userPass'])){
       array_push($_SESSION['errors'], "User Password is Required.");
    }else{
      $userPass = md5(md5($_POST['userPass']));  
    }
  if(empty($_POST['userNo'])){
       array_push($_SESSION['errors'], "User Phone Number is Required.");
    }else{
      $userNo = mysqli_real_escape_string($con,$_POST['userNo']); 
    }


    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      $createdDate = date('Y-m-d h:i:s');
     $sql = "INSERT INTO `tbl_user` (`user_name`,`user_email`,`user_password`,`user_contactNo`,`user_img`,`user_status`,`user_createdDate`) VALUES ('$userName','$userEmail','$userPass','$userNo','','A','$createdDate')";
      $result = mysqli_query($con,$sql);
      $_SESSION['successMsg'] = "Your Account Has been Registered Successfully";
      header("location:userLogIn.php");
      exit();
    }
}

?>

<?php  require ('includes/topNav.php'); ?>
<section class="contact-sec" id="contact">
  <div class="container">
    <h2>Join Us <small>User Registration</small> </h2>
    <?php if (isset($_SESSION['errors'])) { 
                $errors = $_SESSION['errors'];
                foreach ($errors as $error) {   
                ?>
                 <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
              <?php }
               unset($_SESSION['errors']);
                } 
        ?>
       <div style="width: 40%; margin:auto;">

         <form action="registration.php" method="post">
         <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label for="exampleName">Name</label>
                 <input type="text" class="form-control" id="userName" name="userName" aria-describedby="emailHelp" value="<?php echo $userName; ?>">
                </div>
            </div>
         <div class="col-md-12">
              <div class="form-group">
                 <label for="examplePhone">Phone Number</label>
                  <input type="text" class="form-control" id="userNo" name="userNo" aria-describedby="emailHelp" value="<?php echo $userNo; ?>">
              </div>
         </div>
        <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" value="<?php echo $userEmail; ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
             </div>
        </div>
      <!--<div class="col-md-4">
        <label for="exampleTextarea">Insert Image</label>  
        <input type="password" class="form-control" id="exampleTextarea" rows="3">
      </div>-->
      <div class="col-md-12">
        <label for="exampleTextarea">Password</label>
        <input type="password" class="form-control" rows="3" id="userPass" name="userPass" aria-describedby="emailHelp" value="<?php echo $userPass; ?>">
      </div>
      <div class="col-md-12">
        <br>
        <label for="exampleTextarea">Retype Password</label>  
        <input type="password" class="form-control" rows="3" id="userPass" name="userPass" aria-describedby="emailHelp" value="<?php echo $userPass; ?>">
      </div>
      
  </div>
  <div class="col-md-12 text-xs-center action-block"> <!-- <a href="#" class="btn btn-capsul btn-aqua">Submit</a>  -->
            <input type="submit" name="regBtn" style="height: 50px;border-radius: 28px;cursor: pointer;" value="Registration" class="btn btn-capsul btn-aqua">
  </div>

</form>
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
