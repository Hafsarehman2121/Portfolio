<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
 $whereClasue = "WHERE `cons_status` = 'A'";
$consultantName = $consultantExp = $consultantDesc=$consultantType =""; 
$bookTitle = $bookDesc= "";
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

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
  $_SESSION['errors'] = array();
}
$formURl = $slotUrl= $dayUrl ="";

$constID = $slotID = $day = "";
if (isset($_GET['slotID']) ) {
  $slotID = $_GET['slotID'];
  $_SESSION['slotID'] = $slotID;
  $slotUrl = "&slotID=".$slotID;

}else{
  unset($_SESSION['slotID']);
}
if (isset($_GET['day']) ) {
  $day = $_GET['day'];
  $_SESSION['day'] = $day;
  $dayUrl = "&day=".$day;

}else{
  unset($_SESSION['day']);
}
if (isset($_GET['constID'])) {
  $constID = $_GET['constID'];
  $formURl = "bookSlotAppointment.php?constID=".$constID.$dayUrl.$slotUrl;

   $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_id` =  '$constID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $consultantName = $row['cons_name'];
        $consultantExp =  $row['cons_exp'];
        $consultantDesc = $row['cons_desc'];
        $consultantType = $row['cons_type'];
      }
    }
  }
}else{
  $_SESSION['errorMsg'] = "Access Denied..!";
  header("location:viewConsultants.php");
  exit();
}


if(isset($_POST['bookBtn'])){

  if (empty($_POST['bookTitle'])) {
    array_push($_SESSION['errors'], "Title is required");
  }else{

    $bookTitle = mysqli_real_escape_string($con,$_POST['bookTitle']);
   
  }

  if (empty($_POST['bookDesc'])) {
    array_push($_SESSION['errors'], "Description is required");
  }else{

    $bookDesc = mysqli_real_escape_string($con,$_POST['bookDesc']);
   
  }

  if (empty($_POST['day'])) {
    array_push($_SESSION['errors'], "Day is required");
  }else{

    $day = mysqli_real_escape_string($con,$_POST['day']);
    $_SESSION['day'] = $day;
  }

  if (empty($_POST['slotID'])) {
    array_push($_SESSION['errors'], "Slot is required");
  }else{

    $slotID = mysqli_real_escape_string($con,$_POST['slotID']);
    $_SESSION['slotID'] = $slotID;
  }

  if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
    $userID = $_SESSION['userID'];
    $bookDate = date("Y-m-d");
    $bookStatus = "P";
    $sql = "INSERT INTO `tbl_bookappointment` (`book_title`,`book_desc`,`book_userID`,`book_consID`,`book_status`,`book_date`,`book_slotID`) VALUES ('$bookTitle','$bookDesc','$userID','$constID','$bookStatus','$bookDate','$slotID')";
    $result = mysqli_query($con,$sql);
    if ($result) {
      $bookingID = mysqli_insert_id($con);
      $notiTitle = "New Booking Request sent by ".$_SESSION['userFullName'];
      $notiFor = $consultantType;
      $notiForID = $constID;
      $notiStatus = "0";
      $notiType = "B";
      $notiTypeID = $bookingID;
      $notiDate = date("Y-m-d h:i:s");

       $sql = "INSERT INTO `tbl_notifications` (`noti_title`,`noti_for`,`noti_forID`,`noti_type`,`noti_typeID`,`noti_date`,`noti_status`) VALUES ('$notiTitle','$notiFor','$notiForID','$notiType','$notiTypeID','$notiDate','$notiStatus')";
      $result = mysqli_query($con,$sql);
      if($result){
          unset($_SESSION['day']);
          unset($_SESSION['slotID']);

         $_SESSION['successMsg'] = "Booking Request Has been sent.";
        header("location:myAppointments.php");
        exit();

      }

     


    }
  }

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
    <div class="heading text-md-center text-xs-center">
      <h2>Booking Form <h2>
    </div>
    </div>
    <?php
   
       
          
       ?>
     
      <div  style="width:50%; margin:auto;"class="row">
        <div style="width:100%; margin:auto;" class="col-md-12">
          <h3 style="text-center;"> </h3>
          <?php 
            if (isset($_SESSION['errors'])) {
              $errors = $_SESSION['errors'];
              foreach ($errors as  $error) {
                ?>
                <div class="alert alert-danger">
                  <?php echo $error; ?>
                </div>
                <?php
              }
              unset($_SESSION['errors']);
            }
            ?>
          <form action="<?php echo  $formURl; ?>" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input type="text" name="bookTitle" class="form-control" required value="<?php echo $bookTitle; ?>">
                        </div>
                      </div>
 
                          
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-title">Day <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="day" id="day" onchange="getDaySlots();" class=" form-control ">

                            
                              <option value="">Please select</option>
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



                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-title">Slot <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select name ="slotID" id="slotID" class=" form-control select2">
                          </select>

                        </div>

                      </div>


                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-title">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea class="form-control" rows="5" name="bookDesc" required><?php echo $bookDesc; ?></textarea>
                        </div>

                        <div class="form-group">
                       <br>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="bookBtn" value="Book Slot" class="btn btn-sm btn-info float-right">

                        </div>
                      </div>
                    </form>
         
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

<script type="text/javascript">
  <?php if(isset($_SESSION['day'])){
    ?>
    getDaySlots();
    <?php
  } ?>

  function getDaySlots(){
    var day = $("#day").val();
    //alert(cateID);
    $.ajax({
        url:"getDaySlots.php",
        type:"POST",
        data:{
          day: day,
          constID: '<?php echo $constID; ?>'
         },
        success:function(response) {
       
        //  alert(response);
        document.getElementById("slotID").innerHTML =response;
       },
       error:function(){
        alert("error");
       }

      });
  }

</script>
</body>
</html>
