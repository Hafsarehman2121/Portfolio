<?php require ("inc_files/head_file.php"); ?>
<!-- Site wrapper -->
 <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1>Nutritionists</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Consultants List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Nutritionists Data</h3>

        
        </div>
        <div class="card-body">
          
           <table id="nutritionists" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr #</th>
                    <th>Name</th>
                    <th>Contact #</th>
                    <th>CNIC</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Experience</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $sql = "SELECT * FROM `tbl_consultants` WHERE `cons_type`='N' ORDER BY `cons_id` DESC";
                    $result = mysqli_query($con,$sql);
                    if ($result) {
                      if (mysqli_num_rows($result)>0) {
                        $srNo = 1;
                        while ($row = mysqli_fetch_array($result)) {
                          ?>
                          <tr>
                            <td><?php echo $srNo; ?></td>
                            <td><?php echo $row['cons_name']; ?></td>
                            <td><?php echo $row['cons_contactNo']; ?></td>
                            <td><?php echo $row['cons_CNIC']; ?></td>
                            <td><?php echo $row['cons_email']; ?></td>
                            <td>
                              <?php 
                                if($row['cons_img'] != "" && file_exists($row['cons_img'])){
                                  ?>
                                  <img src="<?php echo $row['cons_img']; ?>" style="width: 50px; height: 50px;" />
                                  <?php
                                }else{
                                  echo "N/A";
                                } ?>
                            </td>

                            <td><?php echo getConsultStatus($row['cons_status']); ?></td>
                            <td><?php echo $row['cons_exp']; ?></td>
                            <td>
                              <a href="editNutr.php?consID=<?php echo $row['cons_id']; ?>" class="btn btn-success btn-sm">Edit</a>

                              <a href="" class="btn btn-danger btn-sm">Delete</a>
                            </td>

                          </tr>
                          <?php
                          $srNo++;
                        }
                      }else{
                        ?>
                        <div class="alert alert-info">
                          No User(s) Found.
                        </div>
                        <?php
                      }
                    }

                    ?>
                    </tbody>
                  <!--<tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>-->
                </table>
        </div>
        <!-- /.card-body -->
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



<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
  $(function () {
    $("#nutritionists").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('nutritionists_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
