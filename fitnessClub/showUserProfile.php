<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
 $whereClasue = "WHERE `cons_status` = 'A'";
$userName = $userImage=
$userEmail = $userNumber=" "; 
$senderID = $receiverID = "";
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
if (isset($_GET['consultantID']) && isset($_GET['clientID'])) {
  $senderID = $_GET['consultantID'];
  $receiverID= $_GET['clientID'];
   $sql = "SELECT * FROM `tbl_user` WHERE `user_id` =  '$receiverID'";
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
  $sql2 = "UPDATE `tbl_chat` SET `reader_noti` = '1' WHERE `receiverID` = '$senderID' AND `senderID` = '$receiverID' AND `reader_noti` = '0'";
     $result2 = mysqli_query($con,$sql2);
}




  ?>
    




<!-- BLOG
    ================================================== -->

<section class="blog-sec" id="blog">
  <div class="container" style="padding-left: 350px;">
    <br>
    
     <div class="col-md-8" style="">
        <?php
          require ('chat1.php');
          ?>
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
