<?php require ("inc_files/head_file.php"); 

$userID = $userName = $userContactNo = $userEmail = $userImage = $userStatus = "";

if(isset($_GET['userID']) && isset($_GET['status'])){
  $userID = $_GET['userID'];
  $status = $_GET['status'];

  $sql = "UPDATE `tbl_user` SET `user_status` = '$status' WHERE `user_id` = '$userID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $_SESSION['successMsg'] = "User Status Has been Updated Successfully";
    header("location:editUser.php?userID=".$userID);
    exit();
  }else{
    $_SESSION['errorMsg'] = "User Status Has not been Updated Successfully, Please try again.";
    header("location:editUser.php?userID=".$userID);

  }
} 


if (isset($_GET['userID'])) {
  $userID = $_GET['userID'];

  $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$userID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $userName = $row['user_name'];
        $userEmail = $row['user_email'];
        $userContactNo = $row['user_contactNo'];
        $userStatus = $row['user_status'];
        $userImage = $row['user_img'];
      }
      
    }else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewAllUsers.php");
      exit();
    }
  }else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewAllUsers.php");
      exit();
    }

}else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewAllUsers.php");
      exit();
    }

?>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php require ("inc_files/top_navbar_file.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php require ("inc_files/sidebar_file.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update User Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:;">Users</a></li>
              <li class="breadcrumb-item active">User Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <?php if(isset($_SESSION['successMsg'])){
          ?>
          <div class="alert alert-success">
            <?php 
              echo $_SESSION['successMsg']; 
              unset($_SESSION['successMsg']);
            ?>
          </div>
          <?php
        } ?>

        <?php if(isset($_SESSION['errorMsg'])){
          ?>
          <div class="alert alert-danger">
            <?php 
              echo $_SESSION['errorMsg']; 
              unset($_SESSION['errorMsg']);
            ?>
          </div>
          <?php
        } ?>
        <div class="card-header">
          <h3 class="card-title" style="width:100%;">User Details
            <?php 
              if($userStatus == "A"){
                ?>
                <a href="editUser.php?userID=<?php echo $userID; ?>&status=B" class="btn btn-sm btn-danger float-right">Block User</a>
                <?php
              }else if($userStatus == "B"){
                ?>
                <a href="editUser.php?userID=<?php echo $userID; ?>&status=A" class="btn btn-sm btn-success float-right">Active User</a>

                <?php
              }

             ?>

          </h3>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item" ><b>Image : </b> <span class="float-right"><?php if($userName != "" && file_exists($userImage)){
              ?>
              <img src="<?php echo $userImage; ?>" style ="width:100px; height: 100px;">
              <?php
            }else{
              echo "No Image Available";
            }  ?></span> 
            </li>
            <li class="list-group-item">
              <b>Name : </b> <span class="float-right"><?php echo $userName; ?></span>
            </li>
            <li class="list-group-item">
              <b>Email : </b> <span class="float-right"><?php echo $userEmail; ?></span>
            </li>
            <li class="list-group-item">
              <b>Contact # : </b> <span class="float-right"><?php if($userContactNo ==""){echo "N/A"; }else{ echo $userContactNo; }?></span>
              <li class="list-group-item">
              <b>Status : </b> <span class="float-right"><?php echo getStatusTitle($userStatus); ?></span>
            </li>
            </li>
          </ul>
        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require("inc_files/footer_file.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
