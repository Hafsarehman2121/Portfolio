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
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              
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
          <h3 class="card-title">Dashboard</h3>

          
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('P','GT'); ?></h3>

                  <p>Pending Gym Trainers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('A','GT'); ?></h3>

                  <p>Active Gym Trainers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('R','GT'); ?></h3>

                  <p>Rejected Gym Trainerss</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('B','GT'); ?></h3>

                  <p>Blocked Gym Trainers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
               
              </div>
            </div>
            <!-- ./col -->
          </div>


          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('P','N'); ?></h3>

                  <p>Pending Nutritionists</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('A','N'); ?></h3>

                  <p>Active Nutritionists</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('R','N'); ?></h3>

                  <p>Rejected Nutritionists</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo getTotalConsultantByStatus('B','N'); ?></h3>

                  <p>Blocked Nutritionists</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
               
              </div>
            </div>
            <!-- ./col -->
          </div>
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
</body>
</html>
