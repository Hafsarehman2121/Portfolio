<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
 $whereClasue = "WHERE `cons_status` = 'A'";
$consultantName = $consultantExp = $consultantDesc= $consultantType = $consultantImage = " "; 
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
  header("location:viewConsultants.php");
  exit();
}


$senderID = $receiverID = "";
if(isset($_SESSION['userType'])){
  if($_SESSION['userType'] == 'U' && isset($_GET['constID'])){
     $userID = $_SESSION['userID'];
      $senderID = $_SESSION['userID'];
       $receiverID = $_GET['constID'];

    $sql2 = "UPDATE `tbl_chat` SET `reader_noti` = '1' WHERE `receiver_id` = '$receiverID' AND `sender_id` = '$userID' AND `reader_noti` = '0'";
     $result2 = mysqli_query($con,$sql2);
   
}
}

?>
    




<!-- BLOG
    ================================================== -->


<section class="blog-sec" id="blog">
<div class="container">
  <div class="row">
    <div class="col-md-6" style="min-height: 200px;">
            <div>
               <h2>Consultant Details</h2>
            </div>
        <div class="blog-box">
          <div class="row">
            <div class="col-md-5">
              <div class="blog-image-block"> 
               <?php if($consultantImage != "" && file_exists($consultantImage)){
               ?>
              <img style="width:500px; height: 300px;" src="<?php echo $consultantImage; ?>" alt="" class="img-fluid">
              <?php 
                }else{
                  ?>
              <div class="blog-image-block"> <img style="width:300px; height: 180px; margin-top: 20px;" src="img/user1.jpg" alt="" class="img-fluid"> </div>
         <?php
          } ?>
          </div>
        </div>
         <div class="col-md-7">
          <table style="text-align:left;">
      <tr >
              <td style="font-size:20px; padding-bottom: 20px;" ><b>Name</b></td>
              <td style="padding-bottom: 20px;" ><b><?php echo $consultantName ?></b></td>
        </tr>
        
      <tr>
          
              <td style="font-size:20px; padding-bottom: 20px;"><b>Speciality</b></td>
              <td style="padding-bottom: 20px;"><b><?php echo getUserTitle($consultantType) ?></b></td>
        </tr>
      
      <tr>
          
              <td style="font-size:20px; padding-bottom: 20px;"><b>Experience</b></td>
              <td style="padding-bottom: 20px;"><b><?php echo $consultantExp ?></b></td>
        </tr>
      <tr>
          
              <td style="font-size:20px; padding-bottom: 20px;"><b>Contact Number</b></td>
              <td style="padding-bottom: 20px;"><b><?php echo $consultantNumber?></b></td>
        </tr>

      <tr>
          
              <td style="font-size:20px; padding-bottom: 20px;"><b>Email Address</b></td>
              <td style="padding-bottom: 20px;"><b><?php echo $consultantEmail ?></b></td>
        </tr>
      <tr>
          
              <td style="font-size:20px;"><b>Description</b></td>
              <td><b><?php echo $consultantName ?></b></td>
        </tr>
    </table>
         </div>
</div>
</div>
</div>
<div class="col-md-6">
        <?php
          require ('chat.php');
          ?>
      </div>
</div>

      <div class="row">
        <div class="col-md-4">
          <h3> Monday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'M' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                                  $SID = $row['slot_id'];

                               
                   ?>
                   <tr>
                    <th scope="col">Slot</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td><?php echo $Stime ?></td>
                    <td><?php echo $Etime ?></td>
                    <td>
                      <?php if(checkSlotBookingExist($constID,$SID)==0){
                        ?>
                        <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=M" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                        <?php
                      }else{
                        ?>
                        <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                        <?php
                      } ?>
                      

                    </td>
                  </tr>
                  
                </tbody>
                <?php
              }
              }else{
                    ?>
                    <div class="alert alert-info">No Slot Available on Day</div>
                    <?php
                  }
                }
              ?>


           </table>
       </div>

       <div class="col-md-4">
          <h3> Tuesday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'T' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                                  $SID = $row['slot_id'];
                               
                                   ?>
                                   <tr>
                                    <th scope="col">Slot</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Details</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $Stime ?></td>
                                    <td><?php echo $Etime ?></td>
                                    <td>
                                     <?php if(checkSlotBookingExist($constID,$SID)==0){
                                     ?>
                                    <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=T" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                                                  <?php
                                    }else{
                                      ?>
                                      <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                                      <?php
                               
                                    } ?>
                               </td>
                             </tr>
                                  
                                </tbody>
                                <?php
                              }
                              }else{
                                ?>
                                <div class="alert alert-info">No Slot Available on Day</div>
                                <?php
                              }
                }
              ?>


           </table>
       </div>

       <div class="col-md-4">
          <h3> Wednesday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'W' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                               
                   ?>
                   <tr>
                    <th scope="col">Slot</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td><?php echo $Stime ?></td>
                    <td><?php echo $Etime ?></td>
                    <td>
                     <?php if(checkSlotBookingExist($constID,$SID)==0){
                                     ?>
                    <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=W" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                        <?php
                          }else{
                            ?>
                            <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                            <?php
                     
                          } ?>
                    </td>
                  </tr>
                  
                </tbody>
                <?php
              }
              }else{
                                ?>
                                <div class="alert alert-info">No Slot Available on Day</div>
                                <?php
                              }
                }
              ?>


           </table>
       </div>
       <div class="col-md-4">
          <h3> Thursday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'Th' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                               
                                   ?>
                                   <tr>
                                    <th scope="col">Slot</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Details</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $Stime ?></td>
                                    <td><?php echo $Etime ?></td>
                                    <td>
                                     <?php if(checkSlotBookingExist($constID,$SID)==0){
                                     ?>
                                    <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=Th" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                                       <?php
                                        }else{
                                          ?>
                                          <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                                          <?php
                                   
                                        } ?>
                                    </td>
                                  </tr>
                                  
                                </tbody>
                                <?php
                              }
                              }else{
                                ?>
                                <div class="alert alert-info">No Slot Available on Day</div>
                                <?php
                              }
                }
              ?>


           </table>
       </div>
       <div class="col-md-4">
          <h3> Friday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'F' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                               
                                   ?>
                                   <tr>
                                    <th scope="col">Slot</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Details</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $Stime ?></td>
                                    <td><?php echo $Etime ?></td>
                                    <td>
                                    <?php if(checkSlotBookingExist($constID,$SID)==0){
                                     ?>
                                    <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=F" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                                       <?php
                                        }else{
                                          ?>
                                          <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                                          <?php
                                   
                                        } ?>
                                    </td>
                                  </tr>
                                  
                                </tbody>
                                <?php
                              }
                              }else{
                                ?>
                                <div class="alert alert-info">No Slot Available on Day</div>
                                <?php
                              }
                }
              ?>


           </table>
       </div>
       <div class="col-md-4">
          <h3> Saturday </h3>
         <table class="table table-striped">
                <thead>
                  <?php
                  $sql = "SELECT * FROM `tbl_slot` WHERE `consID` = '$constID' AND `slot_day` = 'S' AND `slot_status` = 'A'";
                        $result = mysqli_query($con,$sql);
                            if ($result) {
                              if (mysqli_num_rows($result) >0) {
                                while ($row = mysqli_fetch_array($result)) {
                                  $Stime = $row['slot_Stime'];
                                  $Etime = $row['slot_Etime'];
                                  
                                   ?>
                                   <tr>
                                    <th scope="col">Slot</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Details</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><?php echo $Stime ?></td>
                                    <td><?php echo $Etime ?></td>
                                    <td>
                                      <?php if(checkSlotBookingExist($constID,$SID)==0){
                                     ?>
                                    <a href="bookSlotAppointment.php?slotID=<?php echo $SID; ?>&constID=<?php echo $constID; ?>&day=F" style="width: 70px;" class="btn btn-sm btn-block btn-success">Book</a>
                                       <?php
                                        }else{
                                          ?>
                                          <a href="javascript:;" style="width: 70px;" class="btn btn-sm btn-block btn-info">Booked</a>
                                          <?php
                                   
                                        } ?>
                                    </td>
                                  </tr>
                                  
                                </tbody>
                                <?php
                              }
                              }else{
                                ?>
                                <div class="alert alert-info">No Slot Available on Day</div>
                                <?php
                              }
                }
              ?>


           </table>
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
  $("#msg").on('keypress',function(e) {
    if(e.which == 13) {
        if (e.key === 'Enter' || e.keyCode === 13) {
      var sid = $("#senderID_input").val();
      var rid = $("#receiverID_input").val();

        sendMsg(sid,rid);
      }
    }
});



   function sendMsg(sid,rid){
    //alert(sid+"-"+rid);
  
  /*--create date and time of msg-Start--*/

      var now = new Date(Date.now());
      var currentDate = now.toLocaleDateString();
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0'+minutes : minutes;
      var formatted = currentDate +" - "+hours + ':' + minutes + ' ' + ampm;
      var chatClass = "";
  /*--create date and time of msg-End--*/

  var msg = $("#msg").val(); // get member message form input
  if(msg == "" || msg == undefined){ //check msg field is empty or not
    alert("Please Write Your Message First than press send button"); //show error message
  }else{
   
    
      var chatClass= 'senderMsg';
    
    <?php if (isset($_SESSION['userID'])) { 
      $id = $_SESSION['userID'];
     ?> 
      var userImage = '<?php echo getUserProfileImage($id); ?>';
      <?php 

      if( !file_exists(getUserProfileImage($id))){ ?>
        var userImage  = "https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg";
      <?php }  
       } ?>

        
    /*--get member name from php session variable-End--*/
    /*--create sender message div for appending in chat box-start--*/
   // var appendDiv = '<div  class= "'+chatClass+'"><p style="margin: 10px 0 10px 0;"> <img style="width: 35px; height: 35px; margin-right: 10px; padding: 5px" class="img-circle" src="'+userImage+'" />'+memberName+'</p><p style="padding-left: 10px;text-align: justify;">'+msg+'</p><span class="time-right">'+formatted+'</span><br><br></div><div class="clearfix"></div>';
    /*--create sender message div for appending in chat box-End--*/



    var appendDiv = '<div class="d-flex justify-content-end  mb-4"><div class="msg_cotainer_send">'+msg+'<span class="msg_time">'+formatted+'</span></div><div class="img_cont_msg"><img src="'+userImage+'" class="rounded-circle user_img_msg"></div></div>';
    $.ajax({
        url:"sendMessage.php",
        type:"POST",
        data:{
          senderID:sid,
          receiverID:rid,
          message: msg
         },
        success:function(response) {
            if(response == 1){
                $("#chatDiv").append(appendDiv); //append msg
                $("#msg").val(''); //empty message text field
                 $('#chatDiv').animate({
                    scrollTop: $('#chatDiv').get(0).scrollHeight
                }, 100);
            }else{
                alert("Something going worng please try later");
            }
       
        
       },
       error:function(){
        alert("error");
       }

      });
   }
 }

</script>
</body>
</html>
