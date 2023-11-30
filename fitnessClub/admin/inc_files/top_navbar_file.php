<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->

      <?php 


      $sqlNoti = "SELECT * FROM `tbl_notifications` WHERE `noti_status` = '0' AND  `noti_for` = 'A' ORDER BY `noti_id`"; 

      $resultNoti = mysqli_query($con,$sqlNoti);
      $totNoti = mysqli_num_rows($resultNoti);

      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php if($totNoti>0){
            ?> 
          <span class="badge badge-warning navbar-badge"><?php echo $totNoti; ?></span>

            <?php
          } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $totNoti; ?> Notifications</span>
          <div class="dropdown-divider"></div>
          <?php while ($rowNoti = mysqli_fetch_array($resultNoti)) {
            if ($rowNoti['noti_type'] == "RN") {
              $notiUrl = "editNutr.php?consID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
            }else if ($rowNoti['noti_type'] == "RG") {
              $notiUrl = "editGT.php?consID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
            }else{
              $notiUrl = "javascript:;";
            }  
            ?>
              <a href="<?php echo $notiUrl; ?>"    
              <i class="fas fa-envelope mr-2"></i> <?php echo $rowNoti['noti_title']; ?>

            </a>
            <div class="dropdown-divider"></div>
            <?php
          } ?>
          
          
          <a href="./allNotifications.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>