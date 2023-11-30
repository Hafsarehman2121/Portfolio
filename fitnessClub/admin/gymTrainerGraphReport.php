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
            <h1>Graphical Report of Gym Trainers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gym Trainers Over All Report</li>
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
          <h3 class="card-title">Gym Trainer Bar Chart Report</h3>

          
        </div>
        <div class="card-body">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

          <canvas id="myGymTrainerGraph" style="width:100%;max-height:400px"></canvas>

        </div>
        <!-- /.card-body -->
        
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

<script>
var activeGymTrainer = "<?php echo getTotalConsultantByStatus('A','GT'); ?>";
var pendingGymTrainer = "<?php echo getTotalConsultantByStatus('P','GT'); ?>";
var rejectedGymTrainer = "<?php echo getTotalConsultantByStatus('R','GT'); ?>";
var blockedGymTrainer = "<?php echo getTotalConsultantByStatus('B','GT'); ?>";

var xValues = ["Blocked", "Active/Approved", "Pending", "Rejected"];
var yValues = [blockedGymTrainer, activeGymTrainer, pendingGymTrainer, rejectedGymTrainer];
var barColors = ["red", "green","blue","orange"];

new Chart("myGymTrainerGraph", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Gym Trainers Stats Bar Chart"
    }
  }
});
</script>

</body>
</html>
