<?php require ("inc_files/head_file.php"); 
$consID = $consName = $consContactNo = $conCNIC = $consEmail = $consImage = $consStatus = $consExp = "";

if(isset($_GET['consID']) && isset($_GET['status'])){
  $consID = $_GET['consID'];
  $status = $_GET['status'];

  $sql = "UPDATE `tbl_consultants` SET `cons_status` = '$status' WHERE `cons_id` = '$consID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    $_SESSION['successMsg'] = "User Status Has been Updated Successfully";
    header("location:editGT.php?consID=".$consID);
    exit();
  }else{
    $_SESSION['errorMsg'] = "Consultant Status Has not been Updated Successfully, Please try again.";
    header("location:editGT.php?consID=".$consID);

  }
} 

if(isset($_GET['notiID'])){
  $notiID = $_GET['notiID'];
  $sql = "UPDATE `tbl_notifications` SET `noti_status` = '1' WHERE `noti_id` = '$notiID'";
  $result = mysqli_query($con,$sql);
}
if (isset($_GET['consID'])) {
  $consID = $_GET['consID'];

  $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_id` = '$consID'";
  $result = mysqli_query($con,$sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $consName = $row['cons_name'];
        $consCNIC = $row['cons_CNIC'];
        $consEmail = $row['cons_email'];
        $consContactNo = $row['cons_contactNo'];
        $consStatus = $row['cons_status'];
        $consExp = $row['cons_exp'];
        $consImage = $row['cons_img'];
      }
      
    }else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewGymTrainers.php");
      exit();
    }
  }else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewGymTrainers.php");
      exit();
    }

}else{
      $_SESSION['error'] = "Access Denied...!";
      header("location:viewGymTrainers.php");
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
            <h1>Update Gym Trainers Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Gym Trainers</a></li>
              <li class="breadcrumb-item active">Gym Trainers Details</li>
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
          <h3 class="card-title" style="width:100%;">Gym Trainers
            <?php 
              if($consStatus == "A"){
                ?>
                <a href="editGT.php?consID=<?php echo $consID; ?>&status=B" class="btn btn-sm btn-danger float-right">Block User</a>
                <?php
              }else if($consStatus == "B"){
                ?>
                <a href="editGT.php?consID=<?php echo $consID; ?>&status=A" class="btn btn-sm btn-success float-right">Active User</a>

                <?php
              }else if($consStatus == "P"){
                ?>
                <a href="editGT.php?consID=<?php echo $consID; ?>&status=A" class="btn btn-sm btn-success float-right">Accept</a>
                <a href="editGT.php?consID=<?php echo $consID; ?>&status=R" class="btn btn-sm btn-danger float-right">Reject</a>
                <?php
              }else if($consStatus == "R"){
                ?>
                <a href="editGT.php?consID=<?php echo $consID; ?>&status=P" class="btn btn-sm btn-success float-right">Accept</a>
                <?php
              }
             ?>


          </h3>
        </div>

          
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item" ><b>Image : </b> <span class="float-right"><?php if($consName != "" && file_exists($consImage)){
              ?>
              <img src="<?php echo $consImage; ?>" style ="width:100px; height: 100px;">
              <?php
            }else{
              echo "No Image Available";
            }  ?></span> 
            </li>
            <li class="list-group-item">
              <b>Name : </b> <span class="float-right"><?php echo $consName; ?></span>
            </li>
            <li class="list-group-item">
              <b>CNIC : </b> <span class="float-right"><?php echo $consCNIC; ?></span>
            </li>
            <li class="list-group-item">
              <b>Email : </b> <span class="float-right"><?php echo $consEmail; ?></span>
            </li>
            <li class="list-group-item">
              <b>Contact # : </b> <span class="float-right"><?php if($consContactNo ==""){echo "N/A"; }else{ echo $consContactNo; }?></span>
            </li>
              <li class="list-group-item">
                <b>Experience : </b> <span class="float-right"><?php echo getStatusTitle($consExp); ?></span>
              </li>
              <li class="list-group-item">
              <b>Status : </b> <span class="float-right"><?php echo getStatusTitle($consStatus); ?></span>
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
