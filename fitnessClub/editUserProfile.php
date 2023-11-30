<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php 
require ('includes/head.php'); 
$userImage = $userName = $userEmail = $userContact = $userStatus ="";
$conID= $_SESSION['userID'];

  $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$conID'";
    $result = mysqli_query($con,$sql);
    if ($result) {
      if(mysqli_num_rows($result) == 1){
        if ($row = mysqli_fetch_array($result)) {
           $userName = $row['user_name'];
           $userEmail = $row['user_email'];
           $userContact = $row['user_contactNo'];
           $userImage = $row['user_img'];
            

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

  
  if(empty($_POST['userNo'])){
       array_push($_SESSION['errors'], "User Phone Number is Required.");
    }else{
      $userNo = mysqli_real_escape_string($con,$_POST['userNo']); 
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
      $sql = "UPDATE `tbl_user` SET 
              `user_name` = '$userName' ,
              `user_contactNo` = '$userContact',
              
              `user_email` = '$userEmail',
              `user_img` = '$userImage'
               
              WHERE `user_id` = '$conID'";
      
      
      $result = mysqli_query($con,$sql);
      if($result){
        
        $_SESSION['successMsg'] = "Your Account Has been Registered Successfully";

            header("location:userProfile.php?constID=".$conID);
                  exit();
      }else{
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:editUserProfile.php?constID=".$conID);
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
    <h2>Edit Profile</small> </h2>
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
     
       <div style="width: 100%; margin:auto;">

         <form action="editUserProfile.php" method="post" enctype="multipart/form-data">
         <div class="row">
          <div class="col-md-12">
          <div class="form-group">
                          <label for="exampleInputUsername1">Image</label>
                          <div class="row">
                            <div class="col-md-11">
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
                 <input type="text" class="form-control" id="userName" name="userName" aria-describedby="emailHelp" value="<?php echo $userName; ?>">
                </div>
            </div>
         <div class="col-md-12">
              <div class="form-group">
                 <label for="examplePhone">Phone Number</label>
                  <input type="text" class="form-control" id="userNo" name="userNo" aria-describedby="emailHelp" value="<?php echo $userContact; ?>">
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
      
      
  </div>
  <div class="col-md-12 text-xs-center action-block"> <!-- <a href="#" class="btn btn-capsul btn-aqua">Submit</a>  -->
            <input type="submit" name="regBtn" style="height: 50px;border-radius: 28px;cursor: pointer;" value="Save Changes" class="btn btn-capsul btn-aqua">
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
