<?php 
function isLogin()
{
	if (isset($_SESSION['adminID']) && $_SESSION['adminID'] !="" && isset($_SESSION['adminFullName']) && $_SESSION['adminFullName'] !="") {
		return true;
	}else{
		return false;
	}
}


function checkWorkCateExist($cateTitle,$cateID=""){
	global $con;
	$sql= "SELECT count(*) as `tot` FROM `tbl_categories` WHERE `cate_title` = '$cateTitle' AND `cate_id` !='$cateID'";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}



function getStatusTitle($status){
	if ($status == "A") {
		return "Active";
	}else if ($status == "B") {
		return "Blocked";
	}else if ($status == "P") {
		return "Pending";
	}else if ($status == "R") {
		return "Rejected";
	}else if ($status == "C") {
		return "Cancelled";
	}
	else {
		return "N/A";
	}
}
function getConsultStatus($status){
	if ($status == "A") {
		return "Active";
	}else if ($status == "B") {
		return "Blocked";
	}else if ($status == "P") {
		return "Pending";
	}else if ($status == "R") {
		return "Rejected";
	}else {
		return "N/A";
	}
}


function getTotalConsultantByStatus($status,$type){
	global $con;
	$sql= "SELECT count(*) as `tot` FROM `tbl_consultants` WHERE `cons_status` = '$status' AND `cons_type` ='$type'";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}
function getCurrentMonthUsers(){
	global $con;
	$sql= "SELECT count(*) as `tot`  FROM `tbl_user`
			WHERE MONTH(`user_createdDate`) = MONTH(CURRENT_DATE())
			AND YEAR(`user_createdDate`) = YEAR(CURRENT_DATE())";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}
function getCurrentYearUsers(){
	global $con;
	$sql= "SELECT count(*) as `tot` FROM `tbl_user`
			WHERE  YEAR(`user_createdDate`) = YEAR(CURRENT_DATE())";
	$result = mysqli_query($con,$sql);
	if($result){
		if ($row = mysqli_fetch_array($result)) {
			return $row['tot'];
		}
	}

}

?>