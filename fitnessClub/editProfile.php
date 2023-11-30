<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php 
require ('includes/head.php'); 
$consultantName = $consultantEmail = $consultantNo = $consultantCNIC = $consultantPass = $consultantExp = $consultantType = $consultantConfPass = $conID = $userImage =
$userName = $userEmail = $userContact = $userStatus ="";
$conID= $_SESSION['userID'];

  $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_id` = '$conID'";
    $result = mysqli_query($con,$sql);
    if ($result) {
      if(mysqli_num_rows($result) == 1){
        if ($row = mysqli_fetch_array($result)) {
           $consultantName = $row['cons_name'];
           $consultantEmail = $row['cons_email'];
           $consultantNo = $row['cons_contactNo'];
           $consultantCNIC = $row['cons_CNIC'];
           $consultantExp = $row['cons_exp'];   
           $userImage = $row['cons_img'];
           $oldUserImage = $row['cons_img'];
            }
           }   
  else{
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:viewAllUsers.php");
        exit();
      }
    }
  

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

      if(checkConsultantEmailexist($consultantEmail, $conID)>0){
       array_push($_SESSION['errors'], "Consultant Email already exist.");

      }

    }

  if(empty($_POST['consultantCNIC'])){
       array_push($_SESSION['errors'], "Consultant CNIC is Required.");
    }else{
      $consultantCNIC = mysqli_real_escape_string($con,$_POST['consultantCNIC']); 
      if(strlen($consultantCNIC) < 13 || strlen($consultantCNIC) > 13){
       array_push($_SESSION['errors'], "Please enter valid Consultant CNIC .");

      }else if(checkConsultantCNICExist($consultantCNIC,$conID)>0){
       array_push($_SESSION['errors'], "Consultant CNIC already.");

      }

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
  if( basename($_FILES["userImage"]["name"] != "")){
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp.'-'.basename($_FILES["userImage"]["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if($check !== false) {
              
            if (file_exists($target_file)) {
                array_push($_SESSION['errors'], "Sorry, file already exists");
            }

            //Check file size
            if ($_FILES["userImage"]["size"] > 50000000000) {
                array_push($_SESSION['errors'], "File is too large");
            }


           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                array_push($_SESSION['errors'], "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
                if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
                  unlink($userImage);
                  $userImage = $target_file;

                } else {
                  array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
                }
            }        
          } else {
              array_push($_SESSION['errors'], "Please Upload Image File Only");
          }
          
        }else{
          $userImage = $oldUserImage;
        }
     

 


    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      $sql = "UPDATE `tbl_consultants` SET 
              `cons_name` = '$consultantName' ,
              `cons_contactNo` = '$consultantNo',
              `cons_CNIC` = '$consultantCNIC',
              `cons_email` = '$consultantEmail',
              `cons_img` = '$userImage',
              `cons_exp` = '$consultantExp' 
              WHERE `cons_id` = '$conID'";
      
      
      $result = mysqli_query($con,$sql);
      if($result){
        
        $_SESSION['successMsg'] = "Your Account Has been Registered Successfully";

            header("location:myProfile.php?constID=".$conID);
                  exit();
      }else{
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:editProfile.php?constID=".$conID);
        exit();
      }

    }
}


?>
<!-- Top Navigation -->
    <?php require 'includes/topNav.php'; ?>

    

<!-- VIDEO
    ================================================== -->
<section class="contact-sec" id="contact">
  <div class="container">
    <br>
    <h2>Edit Profile </h2>
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
          <?php if($userImage != "" && file_exists($userImage)){ ?>
          <img src="<?php echo $userImage; ?>" style="width:100px; height: 100px; border-radius: 100px;">

          <?php
          }else{
          ?>
          <img src="img/user1.jpg" style="width:100px; height: 100px; border-radius: 100px;">
          <?php
          } ?>
                    
    <form action="editProfile.php" method="post" enctype="multipart/form-data">
        <div class="row">
         <div class="col-md-12">
          <div class="form-group">
                          <label for="exampleInputUsername1">Image</label>
                          <div class="row">
                            <div class="col-md-12">
                              <input type="file" class="form-control" id="userImage" name="userImage" style="padding: 0 0 35px 0px;">
                              
                            </div>
                            <div class="col-md-1">
                              
                            </div>

                          </div>
                          
                        </div>
                </div>
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
          
          
          <div class="col-md-12 text-xs-center action-block"> <!-- <a href="#" class="btn btn-capsul btn-aqua">Submit</a>  -->
            <input type="submit" name="Btn" style="height: 50px;border-radius: 28px;cursor: pointer;" value="Save Changes" class="btn btn-capsul btn-aqua">
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
