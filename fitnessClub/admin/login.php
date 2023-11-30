<?php 
require 'inc_files/connection.php';
require 'inc_files/functions.php';

if (isLogin() == true) {
  header("location:index.php");
  exit();
}

$email = $password = "";

if(isset($_POST['loginBtn'])){
    
    if(empty($_POST['email'])){
       array_push($_SESSION['errors'], "Email is Required.");
    }else{
      $email = $_POST['email'];  
    }
    if(empty($_POST['password'])){
       array_push($_SESSION['errors'], "Password is Required.");
    }else{
      $password = md5(md5($_POST['password']));
    }

    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
     $sql = "SELECT * FROM `tbl_admin` WHERE `admin_email` = '$email' and `admin_password` = '$password' ";
     
      $result = mysqli_query($con,$sql);
      if($result){
        if(mysqli_num_rows($result) == 1){
          if($row = mysqli_fetch_assoc($result)){    
              $_SESSION['adminID'] =  $row['admin_id'];
              $_SESSION['adminFullName'] = $row['admin_name'];
              
              header("location:index.php");
              exit();
          }
        }else{
          array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials.");
        }
      }

    }
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitness Club | Admin Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Fitness Club </b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">

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

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
