 <!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php');
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
$slotID = $day =  $Stime = $Etime = $status = "";
$consID=$_SESSION['userID'];

if (isset($_GET['slotID']) ) { 
  $slotID=$_GET['slotID'];
  $sql = "SELECT * FROM  `tbl_slot` WHERE `slot_id` = '$slotID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result)  == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $day = $row['slot_day'];
        $Stime = $row['slot_Stime'];
        $Etime = $row['slot_Etime'];
        $status = $row['slot_status'];

      }
    }
  }

}else{
  $_SESSION['errorMsg'] = "Access Denied..!";
  header("location:mySlots.php");
  exit();
}



if(isset($_POST['set'])){
              if(empty($_POST['day'])){
                 array_push($_SESSION['errors'], "Please select day.");
              }else{
               $day = mysqli_real_escape_string($con,$_POST['day']);  
             }
              if(empty($_POST['ST'])){
                 array_push($_SESSION['errors'], "Please enter start time.");
              }else{
                $STime = mysqli_real_escape_string($con,$_POST['ST']);  
            }
             if(empty($_POST['ET'])){
                 array_push($_SESSION['errors'], "Please enter end time.");
              }else{
                $ETime = mysqli_real_escape_string($con,$_POST['ET']);  
            }

            if(empty($_POST['status'])){
                 array_push($_SESSION['errors'], "Please Select Status.");
              }else{
                $status = mysqli_real_escape_string($con,$_POST['status']);  
            }


            if(checkSlotExist($day,$STime,$ETime,$consID,$slotID)>0){
                 array_push($_SESSION['errors'], "Slot Already Exist B/W Start and End TIme on this day.");

            }

//SELECT * FROM `tbl_slot` WHERE `consID` = '1' AND `slot_day` = 'M' AND  ((`slot_Stime` BETWEEN '11:15' AND '11:40') OR (`slot_Etime` BETWEEN '11:15' AND '11:40' ));
        if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
        $sql= "UPDATE `tbl_slot` SET  `slot_day`= '$day',  `slot_Stime`= '$Stime', `slot_Etime` = '$Etime', `slot_status`= '$status' WHERE `slot_id`= '$slotID'";
          
          $result = mysqli_query($con,$sql);
          if($result){
            $_SESSION['successMsg'] = "Your Schedule Has Been Updated";
          header("location:mySlots.php");
          exit();
          }

          
        }  
   }      


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
    


<section class="contact-sec" id="contact">
  <div class="container">
    <br>
    <h2>Set Schedule</h2>

<div style="width: 30%; margin:auto;">
 <form action="editSlot.php?slotID=<?php echo $slotID; ?>" method="post">   
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
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleName">Day</label>
          <select class="form-select" aria-label="Default select example" name="day" style="width: 290px; height: 40px; border-radius: 10px;">
                   <option <?php if($day == "M"){echo "selected";} ?> value="M">Monday</option>
                   <option  <?php if($day == "T"){echo "selected";} ?> value="T">Tuesday</option>
                   <option  <?php if($day == "W"){echo "selected";} ?> value="W">Wedneday</option>
                   <option  <?php if($day == "Th"){echo "selected";} ?> value="Th">Thursday</option>    
                   <option  <?php if($day == "F"){echo "selected";} ?> value="F">Friday</option>
                   <option  <?php if($day == "S"){echo "selected";} ?> value="S">Saturday</option>
                   <option  <?php if($day == "Sn"){echo "selected";} ?> value="Sn">Sunday</option>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="examplePhone">Start Time</label>
          <input type="time" class="form-control" id="examplePhone" aria-describedby="emailHelp" name="ST" value="<?php echo $Stime ?>" >
        </div>
      </div>
      
      <div class="col-md-12">
        <label for="exampleTextarea">End Time</label>
        <input type="time" class="form-control" id="examplePhone" aria-describedby="emailHelp" name="ET" value="<?php echo $Etime ?>" >
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleName">Status</label>
          <select class="form-select" aria-label="Default select example" name="status" style="width: 290px; height: 40px; border-radius: 10px;">
            <option value="">Select Status</option>
                   <option <?php if($status == "A"){echo "selected";} ?> value="A">Available</option>
                   <option  <?php if($status == "B"){echo "selected";} ?> value="B">Blocked</option>
                   <option  <?php if($status == "BK"){echo "selected";} ?> value="BK">Booked</option>
                   
          </select>
        </div>
      </div>
      <div class="col-md-12 text-xs-center action-block"> 
        <input type="submit" name="set" value="Save Changes" class="btn btn-capsul btn-aqua" style="height: 50px; border-radius: 28px; cursor: pointer;">  
      </div>
    </div>
  </div>
</section>
</form>
</div>




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
