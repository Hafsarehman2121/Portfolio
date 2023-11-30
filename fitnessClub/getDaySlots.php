<?php 
include("includes/connection.php");
require ('includes/head.php');
$slotID = "";
if (isset($_SESSION['slotID'])) {
  $slotID = $_SESSION['slotID'];

}

if(isset($_POST['day']) && isset($_POST['constID'])){
	$day = $_POST['day'];
   $consID = $_POST['constID'];
	   $sql = "SELECT * FROM `tbl_slot` WHERE `slot_status` = 'A' and `slot_day` = '$day' AND `consID` = '$consID'"; 
      $result = mysqli_query($con,$sql);
      if($result){
         if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){ 

               if(checkSlotBookingExist($consID,$row['slot_id'])==0){
?>
              <option <?php if($slotID == $row['slot_id']){ echo "selected"; } ?> value="<?php echo $row['slot_id']; ?>"><?php echo $row['slot_Stime']."-".$row['slot_Etime']; ?></option>
              
       <?php }
    }
           }else{
            ?>
            <option value="">No Slot Available</option>
            <?php
           }
         }
	   }
?>