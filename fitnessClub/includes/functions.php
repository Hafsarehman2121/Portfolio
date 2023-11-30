<?php 
function isLogin()
{
  if (isset($_SESSION['userID']) && $_SESSION['userID'] !="" && isset($_SESSION['userFullName']) && $_SESSION['userFullName'] !="" && isset($_SESSION['userType']) && $_SESSION['userType'] !="") {
    return true;
  }else{
    return false;
  }
}

function getUserTitle($type){
  if ($type == "U") {
    return "User";
  }else if ($type == "GT") {
    return "Gym Trainer";
  }else if ($type == "N") {
    return "Nutritionist";
  }
}
function checkConsultantCNICExist($cnic,$consID=""){
	global $con;
	$sql= "SELECT count(*) as `tot` FROM `tbl_consultants` WHERE `cons_CNIC` = '$cnic' AND `cons_id` !='$consID'";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}

function checkConsultantEmailexist($email,$consID=""){
	global $con;
	$sql= "SELECT count(*) as `tot` FROM `tbl_consultants` WHERE `cons_email` = '$email' AND `cons_id` !='$consID'";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}

function getConsultName($commentUser){
  global $con;
  $sql ="SELECT * FROM `tbl_consultants` WHERE `cons_id`= '$commentUser'";
  $result = mysqli_query($con,$sql);
  if($result){
    if ($row = mysqli_fetch_array($result)) {
      return $row['cons_type'];
    }
  }

}

function getConsultType($commentUser){
  global $con;
  $sql= "SELECT `cons_name` FROM `tbl_consultants` WHERE `cons_id` ='$commentUser'";
  $result = mysqli_query($con,$sql);
  if($result){
    if ($row = mysqli_fetch_array($result)) {
      return $row['cons_name'];
    }
  }

}
function getUserName($commentUser){
  global $con;
  $sql= "SELECT `user_name` FROM `tbl_user` WHERE `user_id` ='$commentUser'";
  $result = mysqli_query($con,$sql);
  if($result){
    if ($row = mysqli_fetch_array($result)) {
      return $row['user_name'];
    }
  }

}



function getSlotDayTime($slotID){
  global $con;
  $sql= "SELECT `slot_day`,`slot_Stime`,`slot_Etime` FROM `tbl_slot` WHERE `slot_id` ='$slotID'";
  $result = mysqli_query($con,$sql);
  if($result){
    if ($row = mysqli_fetch_array($result)) {
      $day = getDayName($row['slot_day']);
      return $day ." - ".$row['slot_Stime']."/".$row['slot_Etime'];
    }
  }

}


function getCurrentPageName(){
    
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
  return $curPageName;
}
function getPageTitle(){
  //$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  

  $curPageName = getCurrentPageName();
  $pageTitle = "Fitness Club ";
  if(isLogin() == true){
    $pageTitle .= " - ".getUserTitle($_SESSION['userType']);
  }
  if ($curPageName == "index.php") {
        $pageTitle .= " | Home";
  }else if($curPageName == "login.php"){
        $pageTitle .= " | Login ";
  }else if($curPageName == "bookingDetails.php"){
        $pageTitle .= " | Booking Details ";
  }else if($curPageName == "dashboard.php"){
        $pageTitle .= " | Dashboard ";
  }else if($curPageName == "viewConsultants.php"){
    $pageTitle .= " | Consultants";
  }else if($curPageName == "myProfile.php"){
    $pageTitle .= " | My Profile";
  }else if($curPageName == "conDetails.php"){
    $pageTitle .= " | Consultant Details";
  }else if($curPageName == "editProfile.php"){
    $pageTitle .= " | Edit Profile";
  }else if($curPageName == "bookSlotAppointment.php"){
    $pageTitle .= " | Book Appointment";
  }else if ($curPageName == "editAppointments.php") {
    $pageTitle .= " | Edit Appointment";
  }
  return $pageTitle;
}

function checkSlotExist($day, $Stime, $Etime, $consID,$slotID="")
{
  global $con;
  $sql="SELECT count(*) as `tot` FROM `tbl_slot` WHERE `consID` = '$consID' AND `slot_day` = '$day' AND  ((`slot_Stime` BETWEEN '$Stime' AND '$Etime') OR (`slot_Etime` BETWEEN '$Stime' AND '$Etime' )) AND `slot_id` != '$slotID'";
  $result = mysqli_query($con,$sql);
  if($result){
   if ($row = mysqli_fetch_array($result)) {
    return $row['tot'];
   }
  }
}


function checkSlotBookingExist($consID,$slotID)
{
  global $con;
  $sql="SELECT count(*) as `tot` FROM `tbl_bookappointment` WHERE `book_consID` = '$consID' AND `book_slotID` = '$slotID' AND `book_status` = 'BK'";
  $result = mysqli_query($con,$sql);
  if($result){
   if ($row = mysqli_fetch_array($result)) {
    return $row['tot'];
   }
  }
}

function slotStatusTitle($status){
  if ($status == "A") {
    return "Available";
  }else if ($status == "B") {
    return "Blocked";
  }else if ($status == "BK") {
    return "Booked";
  }else if ($status == "P") {
    return "Pending";
  }else if ($status == "C") {
    return "Cancelled";
  }
  else{
    return "N/A";
  }
}


function getDayName($day){
  if ($day == "M") {
    return "Monday";
  }else if ($day == "T") {
    return "Tuesday";
  }else if ($day == "W") {
    return "Wednesday";
  }
  else if ($day == "Th") {
    return "Thursday";
  }
  else if ($day == "F") {
    return "Friday";
  }
  else if ($day == "S") {
    return "Saturday";
  }
  else if ($day == "Sn") {
    return "Sunday";
  }
  else{
    return "N/A";
  }
}


function getUserProfileImage($userID)
{
  global $con;
  $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$userID'";

  $result = mysqli_query($con,$sql);
  if($result){
    if ($row = mysqli_fetch_array($result)) {
      return $row['user_img'];
    }
  }
}



function getChatNotifications($senderID,$receiverID){
   global $con;
  $sql = "SELECT count(*) as tot FROM `tbl_chat` WHERE `sender_id` = '$senderID' AND `receiver_id` = '$receiverID' AND `reader_noti` = '0'";
    
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}



function getTotalChatNotifications($receiverID){
   global $con;
  $sql = "SELECT count(*) as tot FROM `tbl_chat` WHERE `receiver_id` = '$receiverID' AND `reader_noti` = '0'";
    
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}


function ratingAgainstBookingID($bookingID){
  global $con;
  $sql = "SELECT `rating_stars` FROM `tbl_ratings` WHERE `rating_bookingID` = '$bookingID'";
    
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['rating_stars'];
    }
}


function getOverAllRating($consID){
  global $con;
  $totRateStars = 0;
  $sql = "SELECT * FROM `tbl_ratings` WHERE `rating_consID` = '$consID'";
  $result = mysqli_query($con,$sql);
  if($result){
    $totUsersRate = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)) {
      $totRateStars += $row['rating_stars'];
    }
    if($totUsersRate == 0){
      return "N/A";
    }else{
      return round(($totRateStars/$totUsersRate),2);
    }
  }

}


?>