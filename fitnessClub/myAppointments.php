<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">

<?php
$consultantID="";
require ('includes/head.php');
$userID=$_SESSION['userID'];
?>

<style type="text/css">
    
.star-rating {
  line-height:32px;
  font-size:1.25em;
}

.star-rating .fa-star{color: yellow;}

</style>
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
    



<!-- About 
    ================================================== -->
<section class="about-sec parallax-section" id="about">
  <br>
    <div style="width: 70%; margin:auto;">
      <div class="col-md-12">
        <br>
        <h3 style="text-center">My Appointments</h3>
        
      </div>
      
      <br>
      <div class="col-md-12">
        <?php if(isset($_SESSION['errorMsg'])){
          ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg']); ?>
          </div>
          <?php
        } ?>

        <?php if(isset($_SESSION['successMsg'])){
          ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']); ?>
          </div>
          <?php
        } ?>
        <?php


     
        ?>

        <table class="table table-striped table-dark">
           <thead>
                <tr>
                  <th scope="col">Consultant Name</th>
                  <th scope="col">Consultant Type</th>
                  <th scope="col">Day</th>
                  <th scope="col">Date</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Status</th>
                  <th scope="col">Details</th>
                  <th scope="col">Rating</th>

                 
                </tr>
           </thead>
      <?php 
     
         $sql = "SELECT * FROM `tbl_bookappointment`  WHERE `book_userID`= '$userID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
              if (mysqli_num_rows($result)>0) {

              while ($row = mysqli_fetch_array($result)) {
             $consultantID = $row['book_consID'];
             $slotID=$row['book_slotID'];
             $bookingID = $row['book_id'];
          

        ?>
         <tbody>
          <tr>
            <?php
             $sql = "SELECT * FROM `tbl_consultants`  WHERE `cons_id`= '$consultantID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
              if ($row1 = mysqli_fetch_array($result)) {
                 $consultantName=$row1['cons_name'];
                 $consultantType=$row1['cons_type'];
            }

          }
          ?>
            <td scope="row"><?php echo $consultantName ; ?></td>
            <td scope="row"><?php echo getUserTitle($row1['cons_type']) ; ?></td>
             <?php
            $sql = "SELECT * FROM `tbl_slot`  WHERE `slot_id`= '$slotID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
              if ($row2 = mysqli_fetch_array($result)) {
                 $slotDay=$row2['slot_day'];
            }
          }
          ?>

            <td><?php echo getDayName($row2['slot_day']); ?></td>
            <td><?php echo $row['book_date']; ?></td>
             <?php
            $sql = "SELECT * FROM `tbl_slot`  WHERE `slot_id`= '$slotID' ";
            $result = mysqli_query($con,$sql); 
            if($result){
              if ($row2 = mysqli_fetch_array($result)) {
                 $slotStime=$row2['slot_Stime'];
                 $slotEtime=$row2['slot_Etime'];

            }
          }
          ?>
            <td><?php echo $slotStime; ?></td>
            <td><?php echo $slotEtime; ?></td>
            <td><?php echo slotStatusTitle($row['book_status']); ?></td>
            <td><a href="conDetails.php?constID=<?php echo $consultantID; ?>"><button type="button" class="btn btn-primary"><span  class="fa fa-comments-o"></span> Chat <?php $totChatNotifications = getChatNotifications($consultantID,$_SESSION['userID']); 
                if($totChatNotifications>0){
                ?>
                <span class="badge badge-warning"><?php echo $totChatNotifications; ?></span>
                <?php
               }


             ?></button></a></td>


             <td>
               
               <?php  $totRate = 0;
                          if(ratingAgainstBookingID($bookingID) !="N/A" && ratingAgainstBookingID($bookingID) != ""){
                              $totRate = ratingAgainstBookingID($bookingID);
                          } ?>
                 <div id="starsRate_<?php echo $bookingID ?>" class="star-rating">
                  
                  <span class="fa <?php if($totRate>=1){echo "fa-star";}else{ echo "fa-star-o";} ?> " onclick="ratings('1',<?php echo $bookingID; ?>,<?php echo $consultantID; ?>,<?php echo $userID; ?>)" data-rating="1"></span>
                  <span class="fa <?php if($totRate>=2 && $totRate !="N/A" &&  $totRate !="0"){echo "fa-star";}else{ echo "fa-star-o";} ?>" onclick="ratings('2',<?php echo $bookingID; ?>,<?php echo $consultantID; ?>,<?php echo $userID; ?>)" data-rating="2"></span>
                  <span class="fa <?php if($totRate>=3 && $totRate !="N/A" &&  $totRate !="0"){echo "fa-star";}else{ echo "fa-star-o";} ?>" onclick="ratings('3',<?php echo $bookingID; ?>,<?php echo $consultantID; ?>,<?php echo $userID; ?>)" data-rating="3"></span>
                  <span class="fa <?php if($totRate>=4 && $totRate !="N/A" &&  $totRate !="0"){echo "fa-star";}else{ echo "fa-star-o";} ?>" onclick="ratings('4',<?php echo $bookingID; ?>,<?php echo $consultantID; ?>,<?php echo $userID; ?>)" data-rating="4"></span>
                  <span class="fa <?php if($totRate>=5 && $totRate !="N/A" &&  $totRate !="0"){echo "fa-star";}else{ echo "fa-star-o";} ?>" onclick="ratings('5',<?php echo $bookingID; ?>,<?php echo $consultantID; ?>,<?php echo $userID; ?>)" data-rating="5"></span>
                  
                  <input type="hidden" id="rating" name="whatever1" class="rating-value" value="<?php echo $totRate; ?>">
                </div>
                <div id="totRateVal_<?php echo $bookingID; ?>">
                <?php;
                echo $totRate; 
              ?>
            </div>

                             
                              
             </td>

            
          </tr>
          
        </tbody>
      <?php
      
    }
  }
    
          }
        

    ?>
</table>
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
      var $star_rating = $('.star-rating .fa');


    function ratings(stars,bookingID,consID,userID) {
       // alert(stars+" - "+materialDetailID);

       alert(stars+" "+bookingID+" "+consID+" "+userID);
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));

        $.ajax({//remove cart-item from dataBase
                url:"ratings.php",
                type:"POST",
                data:{
                  userID: userID,
                  consID: consID,
                  bookingID: bookingID,
                  rating : stars
                },
                success:function(response) {
                    if(response != "0"){
                      // alert ("rating done");
                      $("#rating").val(response);
                      $("#totRateVal_"+bookingID).html(response);
                      $("#starsRate_"+bookingID).hide();
                     }else {
                      console.log(response);
                      alert("Some thing going Wrong");
                    }
                 
               },
               error:function(jqXHR, exception){
                alert(jqXHR);//display error log
                alert("error occured while deleting");
               }

              });

      //  return SetRatingStar();
    }   


</script>
  
</body>
</html>
