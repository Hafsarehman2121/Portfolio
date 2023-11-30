<?php 
require ('includes/head.php'); 
$consultantName = $consultantEmail = $consultantNo = $consultantCNIC = $consultantPass = $consultantExp = $consultantType = $consultantConfPass = "";
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
if(isset($_POST['Btn'])){
  if(empty($_POST['consultantName'])){
       array_push($_SESSION['errors'], "Consultant Name is Required.");
    }else{
      $consultantName = mysqli_real_escape_string($con,$_POST['consultantName']);  
    }
  if(empty($_POST['consultantEmail'])){
       array_push($_SESSION['errors'], "Consultant Email is Required.");
    }else{
      $consultantEmail = mysqli_real_escape_string($con,$_POST['consultantEmail']);

      if(checkConsultantEmailexist($consultantEmail)>0){
       array_push($_SESSION['errors'], "Consultant Email already exist.");

      }

    }

  if(empty($_POST['consultantCNIC'])){
       array_push($_SESSION['errors'], "Consultant CNIC is Required.");
    }else{
      $consultantCNIC = mysqli_real_escape_string($con,$_POST['consultantCNIC']); 
      if(strlen($consultantCNIC) < 13 || strlen($consultantCNIC) > 13){
       array_push($_SESSION['errors'], "Please enter valid Consultant CNIC .");

      }else if(checkConsultantCNICExist($consultantCNIC)>0){
       array_push($_SESSION['errors'], "Consultant CNIC already.");

      }

    }
  if(empty($_POST['consultantPass'])){
       array_push($_SESSION['errors'], "Consultant Password is Required.");

    }else{
      $consultantPass = mysqli_real_escape_string($con,$_POST['consultantPass']);
      if (strlen($consultantPass) < '8') {
            array_push($_SESSION['errors'], "Your Password Must Contain At Least 8 Characters!");
        }
        elseif(!preg_match("#[0-9]+#",$consultantPass)) {
            array_push($_SESSION['errors'],"Your Password Must Contain At Least 1 Number!");
        }
        elseif(!preg_match("#[A-Z]+#",$consultantPass)) {
           array_push($_SESSION['errors'],"Your Password Must Contain At Least 1 Capital Letter!");
        }
        elseif(!preg_match("#[a-z]+#",$consultantPass)) {
            array_push($_SESSION['errors'], "Your Password Must Contain At Least 1 Lowercase Letter!");
        } 
    }


    if(empty($_POST['consultantConfPass'])){
       array_push($_SESSION['errors'], "Consultant Password is Required.");
    }else{
      $consultantConfPass = mysqli_real_escape_string($con,$_POST['consultantConfPass']);
    }


    if($consultantPass != $consultantConfPass){
       array_push($_SESSION['errors'], "Consultant Password Not Matched.");

    }else{
      $consultantPass = md5(md5($consultantPass));
    }

  if(empty($_POST['consultantExp'])){
       array_push($_SESSION['errors'], "Consultant Experience is Required.");
    }else{
      $consultantExp = mysqli_real_escape_string($con,$_POST['consultantExp']); 
    }
  if(empty($_POST['consultantNo'])){
       array_push($_SESSION['errors'], "Consultant Phone Number is Required.");
    }else{
      $consultantNo = mysqli_real_escape_string($con,$_POST['consultantNo']);
    }

  if(empty($_POST['consultantType'])){
       array_push($_SESSION['errors'], "Consultant Type is Required.");
    }else{
      $consultantType = mysqli_real_escape_string($con,$_POST['consultantType']);
    }


    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      $sql = "INSERT INTO `tbl_consultants` (`cons_name`,`cons_contactNo`,`cons_CNIC`,`cons_email`,`cons_password`,`cons_type`,`cons_exp`,`cons_img`,`cons_status`) VALUES ('$consultantName','$consultantNo','$consultantCNIC','$consultantEmail','$consultantPass','$consultantType','$consultantExp','','P')";
      $result = mysqli_query($con,$sql);
      if($result){
        $consultantID = mysqli_insert_id($con);

        $notiTitle= "New Consultant :".$consultantName." Registration Request.";
        $notiStatus = 0;
        $notiFor= "A";
        $notiForID = 0;
        if($consultantType == "N"){
          $notiType = "RN";  
        }else if($consultantType == "GT"){
          $notiType = "RG";  
        }else{
          $notiType = ""; 
        }

        
        $notiTypeID = $consultantID;
        $notiDate = date("Y-m-d h:i:s");
        $sql = "INSERT INTO `tbl_notifications` (`noti_title`,`noti_for`,`noti_forID`,`noti_type`,`noti_typeID`,`noti_date`,`noti_status`) VALUES ('$notiTitle','$notiFor','$notiForID','$notiType','$notiTypeID','$notiDate','$notiStatus')";
        $result = mysqli_query($con,$sql);
        $_SESSION['successMsg'] = "Your Account Registration Request has been sent to Admin";
            header("location:userLogIn.php");
                  exit();
      }

    }
}


?>
<!-- Top Navigation -->
    <?php require 'includes/topNav.php'; ?>

    

<!-- VIDEO
    ================================================== -->
<br>
<section class="contact-sec" id="contact">

  <div class="container">
    <br>
    <h2>Join Us <small>Consultant Registration</small> </h2>
    <!-- <div class="alert alert-danger">sadasd</div> -->
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

    <form action="consultantRegistration.php" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleName">Name</label>
              <input type="text" class="form-control" id="consultantName" name="consultantName" aria-describedby="emailHelp" value="<?php echo $consultantName; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="examplePhone">Phone Number</label>
              <input type="text" class="form-control" id="consultantNo" name="consultantNo" aria-describedby="emailHelp" value="<?php echo $consultantNo; ?>">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="consultantEmail" name="consultantEmail" aria-describedby="emailHelp" value="<?php echo $consultantEmail; ?>">
              <small id="emailHelp" class="form-text text-muted"> We'll never share your email with anyone else.</small> </div>
          </div>
         <div class="col-md-12">
            <div class="form-group">
              <label for="examplePhone">CNIC</label>
              <input type="text" class="form-control" id="consultantCNIC" name="consultantCNIC"  aria-describedby="emailHelp" value="<?php echo $consultantCNIC; ?>">
            </div>
          </div>
          <!--<div class="col-md-4">
            <label for="exampleTextarea">Insert Image</label>  
            <input type="password" class="form-control" id="exampleTextarea" rows="3">
          </div>-->
          <div class="col-md-12">
            <div class="form-group">
              <label for="examplePhone">Experience</label>
              <input type="text" class="form-control" id="consultantExp" name="consultantExp" aria-describedby="emailHelp" value="<?php echo $consultantExp; ?>" >
            </div>
          </div>
          <div class="col-md-12">
            <label for="exampleTextarea">Password</label>
            <input type="password" class="form-control" id="consultantPass" name="consultantPass" rows="3" >
          </div>
          <div class="col-md-12">
            <label for="exampleTextarea">Retype Password</label>  
            <input type="password" class="form-control"  id="consultantConfPass" name="consultantConfPass" rows="3" >
          </div>
          <div class="col-md-12">
            <div class="form-group">
               <br>
              <label for="examplePhone">Join As A</label>
              <select name="consultantType" required="required" class="form-control" id="consultantType" name="consultantType" aria-describedby="emailHelp" >
                <option <?php if ($consultantType =="N" ) { echo "selected"; } ?>  value="N" >Nutritionist</option>
                <option <?php if ($consultantType =="GT" ) { echo "selected"; } ?> value="GT" >Gym Trainer</option>
              </select>

            </div>
          </div>
          <div class="col-md-12 text-xs-center action-block"> <!-- <a href="#" class="btn btn-capsul btn-aqua">Submit</a>  -->
            <input type="submit" name="Btn" style="height: 50px;border-radius: 28px;cursor: pointer;" value="Registration" class="btn btn-capsul btn-aqua">
          </div>
        </div>
    </form>
  </div>
</div>
</section>
<?php require 'includes/footer.php'; ?>
<!-- Bootstrap core JavaScript
    ================================================== --> 
<?php require 'includes/scripts.php'; ?>
</body>
</html>
