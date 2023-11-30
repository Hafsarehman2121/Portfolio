<!-- Top Navigation -->

<?php 
if(isset($_SESSION['userID'])){
  $conID=$_SESSION['userID'];    

}

?>
    <nav class="navbar navbar-toggleable-md mb-4 top-bar navbar-static-top sps sps--abv">
        <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse1" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     <div class="image">
          <img src="img/logo3.png" class="img-circle elevation-2" alt="User Image">
        </div>
      <div class="collapse navbar-collapse" id="navbarCollapse1">
        <ul class="navbar-nav ml-auto">
         
        <!-- <li class="nav-item dropdown">
          <a class="nav-link  dropdown-toggle" href="javascript:;" id="dropdownMenuButton1" data-bs-toggle="dropdown">  Registration </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#"> As a User</a></li>
          <li><a class="dropdown-item" href="#"> As a Consultant </a></li>
          
          </ul>
        </li> -->
        <!---->

       <!-- <li class="nav-item"> <a class="nav-link" href="#gallery">About</a> </li>
        <li class="nav-item"> <a class="nav-link" href="#contact">Contact</a> </li>-->
           
         
        <?php if(isLogin() == false){ ?>

               <li class="nav-item"> <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
              <li class="nav-item"> <a class="nav-link" href="#video">Videos</a> </li>
              <li class="nav-item"> <a class="nav-link" href="displayArticles.php">Articles</a> </li>
               <li class="nav-item"> <a class="nav-link" href="findGym.php">Find Gyms</a> </li>
               
             <li class="nav-item ">
              <a href="aboutus.php" id="login" class="nav-link">
                About Us
              </a>
              
            </li>
                  <li class="nav-item dropdown">
              <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" class="nav-link">
                Registration
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="registration.php">Aa a User</a>
                <a class="dropdown-item" href="consultantRegistration.php">As a Consultant</a>
                
              </ul>
            </li>

            
             <li class="nav-item ">
              <a href="userLogIn.php" id="login" class="nav-link">
                Sign In
              </a>
              
            </li>
            
        <?php }else{

          
            if($_SESSION['userType']=='GT' || $_SESSION['userType']=='N'){
                  $userType = $_SESSION['userType'];
                  $sqlNoti = "SELECT * FROM `tbl_notifications` WHERE `noti_status` = '0' AND  `noti_for` = '$userType'  AND `noti_forID` = '$conID' "; 

                  $resultNoti = mysqli_query($con,$sqlNoti);
                  $totNoti = mysqli_num_rows($resultNoti);

                 ?>
                  <li class="nav-item"> <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#benefits">Videos</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="displayArticles.php">Articles</a> </li>
                   <li class="nav-item"> <a class="nav-link" href="findGym.php">Find Gyms</a> </li>
                  <li class="nav-item dropdown">
                    
                 <a class="nav-link" data-toggle="dropdown" href="#"><?php if($totNoti>0){
                      ?> 
                    <span class="badge badge-warning navbar-badge"><?php echo $totNoti; ?></span>

                      <?php
                    } ?>Notifications
                   </a>
                 
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header"><?php echo $totNoti; ?> Notifications</span>
                <div class="dropdown-divider"></div>
                <?php while ($rowNoti = mysqli_fetch_array($resultNoti)) {
                if ($rowNoti['noti_type'] == "B") {

                    $notiUrl = "bookingDetails.php?bookingID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
                }else{
                     $notiUrl = "javascript:;";
                }  
            ?>
              <a href="<?php echo $notiUrl; ?>" >   
              <i class="fas fa-envelope mr-2"></i> <?php echo $rowNoti['noti_title']; ?></a>
              </div>
              </li>
              <li class="nav-item"><a class="nav-link" href="#benefits"></a>   </li>
              <li class="nav-item"><a class="nav-link" href="#benefits"></a>   </li>
              <li class="nav-item"><a class="nav-link" href="#benefits"></a>   </li>
               <li class="nav-item"><a class="nav-link" href="#benefits"></a>   </li>
             
              
             <?php
           } 
          }    
         if($_SESSION['userType']=='U'){
             $userType = $_SESSION['userType'];
           
               $sqlNoti = "SELECT * FROM `tbl_notifications` WHERE `noti_status` = '0' AND  `noti_for` = 'U'  AND `noti_forID` = '$conID' "; 
                
                $resultNoti = mysqli_query($con,$sqlNoti);
                $totNoti = mysqli_num_rows($resultNoti);
                ?>
               <li class="nav-item"> <a class="nav-link" href="userdashboard.php">Home <span class="sr-only">(current)</span></a> </li>
               <li class="nav-item"> <a class="nav-link" href="#benefits">Videos</a> </li>
               <li class="nav-item"> <a class="nav-link" href="displayArticles.php">Articles</a> </li>
                <li class="nav-item"> <a class="nav-link" href="findGym.php">Find Gyms</a> </li>
               <li class="nav-item"> <a class="nav-link" href="viewConsultants.php">Consultants</a> </li>
               <li class="nav-item"> <a class="nav-link" href="viewConsultants.php">Book Appointment</a> </li>
               <li class="nav-item">

                <a class="nav-link" href="myAppointments.php"> <?php $totChatNoti = getTotalChatNotifications($_SESSION['userID']); 
                if($totChatNoti>0){
                ?>
                <span class="badge badge-warning"><?php echo $totChatNoti; ?></span>
                <?php
               }


             ?>
                  My Appointments  
               </a> </li>
               <li class="nav-item dropdown">
               
               <a class="nav-link" data-toggle="dropdown" href="#"><?php if($totNoti>0){
                      ?> 
                    <span class="badge badge-warning navbar-badge"><?php echo $totNoti; ?></span>

                      <?php
                    } ?>
                  Notifications</a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
               <span class="dropdown-item dropdown-header"><?php echo $totNoti; ?>   Notifications</span>
               <div class="dropdown-divider"></div>
               <?php while ($rowNoti = mysqli_fetch_array($resultNoti)) {
                if ($rowNoti['noti_for'] == "U") {

                 $notiUrl = "userBookingDetails.php?bookingID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
                }else{
                  $notiUrl = "javascript:;";
                }  
            ?>
              <a href="<?php echo $notiUrl; ?>" >   
              <i class=""></i> <?php echo $rowNoti['noti_title']; ?>

            </a>
          
            <div class="dropdown-divider"></div>
            <?php
          } 
            

         } ?>
          <li  style="padding-right: -50px;" class="nav-item dropdown">
          <a href="javascript:;" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" class="nav-link">

            <?php if(isset($_SESSION['userImage'])){
              if($_SESSION['userImage'] != "" && file_exists($_SESSION['userImage'])){
                ?>
                <img src="<?php echo $_SESSION['userImage']; ?>" style="width:30px; height: 30px; border-radius: 100px;">
                <?php
              }else{
                ?>
                <img src="img/user1.jpg" style="width:30px; height: 30px; border-radius: 100px;">
                <?php
              }
            }
            ?>
            
            <?php echo $_SESSION['userFullName']; ?>
            <small>(<?php echo getUserTitle($_SESSION['userType']); ?>)</small>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
            if($_SESSION['userType']=='GT' || $_SESSION['userType']=='N'){
              ?>
            
              
              <a class="dropdown-item" href="mySlots.php">My Slots</a>
              <a class="dropdown-item" href="myProfile.php?constID=<?php echo $conID; ?>">My Profile</a>
              
              <a class="dropdown-item" href="logout.php">Logout</a>
              
              <?php
            }
            
            else{
              ?>
               <a class="dropdown-item" href="userProfile.php?constID=<?php echo $conID;?>">My Profile</a>
               <a class="dropdown-item" href="logout.php">Logout</a>
            
            <?php } ?>
          </ul>
        </li>
       
         
        <?php } ?>
        </ul>
      </div>
            </div>
    </nav>
