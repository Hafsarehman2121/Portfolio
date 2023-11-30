<?php 
require ('includes/head.php'); 

if(isLogin() == true){
  header("location:dashboard.php");
  exit();
}

$userName = $userEmail = $userPass =  $userNo = "";
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
if(isset($_POST['loginBtn'])){

      if(empty($_POST['userEmail'])){
       array_push($_SESSION['errors'], "User Email is Required.");
    }else{
      $userEmail = $_POST['userEmail'];  
    }
  if(empty($_POST['userPass'])){
       array_push($_SESSION['errors'], "User Password is Required.");
    }else{
      $userPass = md5(md5($_POST['userPass']));  
    }

    if(empty($_POST['userType'])){
       array_push($_SESSION['errors'], "Select User Type .");
    }else{
      $userType = $_POST['userType'];  
    }


    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      if($userType == "U"){
        $sql = "SELECT * FROM `tbl_user` WHERE `user_email` = '$userEmail' and `user_password` = '$userPass' AND `user_status` = 'A'";
     
        $result = mysqli_query($con,$sql);
        if($result){
          if(mysqli_num_rows($result) == 1){
            if ($row = mysqli_fetch_array($result)) {
              $_SESSION['userID'] = $row['user_id'];
              $_SESSION['userFullName'] = $row['user_name'];
              //$_SESSION['userImage'] = $row[''];
              $_SESSION['userType'] = 'U';

              header("location:userdashboard.php");
              exit();

            }
          }else{
          array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials.");

          }

        }


      }else if ($userType == "GT" || $userType == "N") {
       $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_email` = '$userEmail' and `cons_password` = '$userPass' AND `cons_status` = 'A' AND `cons_type` = '$userType'";
     
        $result = mysqli_query($con,$sql);
        if($result){
          if(mysqli_num_rows($result) == 1){
            if ($row = mysqli_fetch_array($result)) {
              $_SESSION['userID'] = $row['cons_id'];
              $_SESSION['userFullName'] = $row['cons_name'];
              $_SESSION['userImage'] = $row['cons_img'];

              $_SESSION['userType'] = $userType;

              header("location:dashboard.php");
              exit();

            }
          }else{
          array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials.");
            
          }

        }
      }
    }
    

}
?>


<!-- Top Navigation -->
    
<?php 
require ('includes/topNav.php'); ?>
    
<!-- Swiper Silder
    ================================================== --> 
<!-- Slider main container -->


<!-- Benefits
    ================================================== -->

<!-- About 
    ================================================== -->


<!-- BLOG
    ================================================== -->



<!-- VIDEO
    ================================================== -->
<section class="contact-sec" id="contact">
  <div class="container">
    <br>
    <h2><small>User LogIn</small> </h2>
    <?php 
    if (isset($_SESSION['successMsg'])) {
      ?>
      <div class="alert alert-success">
        <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']); ?>
      </div>
      <?php
    }

    if (isset($_SESSION['errors'])) { 
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

         <form action="userLogIn.php" method="post">
           <div class="row">
             
           
            <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" value="<?php echo $userEmail; ?>">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                 </div>
            </div>
          
            <div class="col-md-12">
              <label for="exampleTextarea">Password</label>
              <input type="password" class="form-control" rows="3" id="userPass" name="userPass" aria-describedby="emailHelp" value="<?php echo $userPass; ?>">
            </div>
            <div class="col-md-12">
                   <br>
                   <br>
                   <div>
                    <label  for="html">LogIn As</label>
                  </div>
                   
                   <input type="radio" style="position: relative; top: 5px;" id="us" name="userType" value="U">&nbsp;&nbsp;
                   
                   <label  for="html">User</label>&nbsp;&nbsp;


                   <input type="radio" id="con" name="userType"  style="position: relative; top: 5px;" value="GT">&nbsp;&nbsp;
                   <label for="css">Gym Trainer</label>&nbsp;&nbsp;


                   <input type="radio" id="con"  style="position: relative; top: 5px;" name="userType" value="N">&nbsp;&nbsp;
                   <label for="css">Nutritionist</label>&nbsp;&nbsp;
            </div>
        
          </div>
  <div class="col-md-12 text-xs-center action-block"> <!-- <a href="#" class="btn btn-capsul btn-aqua">Submit</a>  -->
            <input type="submit" name="loginBtn" style="height: 50px;border-radius: 28px;cursor: pointer;" value="Log In" class="btn btn-capsul btn-aqua">
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
