<?php ob_start(); ?>
<?php require ("inc_files/head_file.php");
 $categoryName ="";
 ?>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php require ("inc_files/top_navbar_file.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php require ("inc_files/sidebar_file.php"); ?>

<?php
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
if(isset($_POST['Btn'])){
  if(empty($_POST['categoryName'])){
       array_push($_SESSION['errors'], "Category Name is Required.");
    }else{
      $categoryName = mysqli_real_escape_string($con,$_POST['categoryName']);  
    }


     if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $sql= "INSERT INTO `tbl_articlescategory` (`cat_name`) VALUES ('$categoryName')";
    $result = mysqli_query($con,$sql);
    if($result){
      $_SESSION['successMsg'] = "Category has been added Successfully";
       header("location:addCategory.php");
      exit();
    }
  }
  }

  
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
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
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <h1 >Add Articles Category</h1>
          <?php if (isset($_SESSION['errors'])) { 
                $errors = $_SESSION['errors'];
                foreach ($errors as $error) {   
                ?>
                 <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
              <?php }
               unset($_SESSION['errors']);
                } 
        ?>
          <br>
          <br>
          <form action="addCategory.php" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleName">Enter Category Name</label>
                    <input type="text" class="form-control" id="" name="categoryName" aria-describedby="emailHelp" value="">
                    
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                    
                    <input type="submit" name="Btn" value="Submit" style="height:50px; width:90px;" type="button" class="btn btn-dark">
                </div>
              </div>
              
            </div>
          </form>
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
