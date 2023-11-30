<?php require ("inc_files/head_file.php"); ?>
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
            <h1>All Notifications</h1>
          </div>
             

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Notifications</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

          <?php 

        $i=1;
        $sqlNoti = "SELECT * FROM `tbl_notifications`  ORDER BY `noti_id`"; 

        $resultNoti = mysqli_query($con,$sqlNoti);
        $totNoti = mysqli_num_rows($resultNoti);

        
        
             
              ?>
            
             <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Notifications</th>
        
    
      </tr>
    </thead>
    <tbody>
      
       <?php   
         while ($rowNoti = mysqli_fetch_array($resultNoti)) {
              if ($rowNoti['noti_type'] == "RN") {
                $notiUrl = "editNutr.php?consID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
              }else if ($rowNoti['noti_type'] == "RG") {
                $notiUrl = "editGT.php?consID=".$rowNoti['noti_typeID']."&notiID=".$rowNoti['noti_id'];
              }else{
                $notiUrl = "javascript:;";
              } 
          ?>
      <tr>
        <td> <?php echo $rowNoti['noti_id']; ?></td>
        <td> <a href="<?php echo $notiUrl; ?>"    
                <i class="fas fa-envelope mr-2"></i> <?php echo $rowNoti['noti_title']; ?>

              </a></td>
        
      </tr>
    <?php
  }
  ?> 
  </tbody>
</table>


        
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
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
