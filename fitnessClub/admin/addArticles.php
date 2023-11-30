<?php require ("inc_files/head_file.php"); ?>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php require ("inc_files/top_navbar_file.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php require ("inc_files/sidebar_file.php");
 $articleTitle = $articleImg = $articleDesc = $articalCat ="";
  ?>
<?php
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}
if(isset($_POST['addBtn'])){
  if(empty($_POST['articleTitle'])){
       array_push($_SESSION['errors'], "Article Title is Required.");
    }else{
      $articleTitle = mysqli_real_escape_string($con,$_POST['articleTitle']);  
    }

    if(empty($_POST['articalCat'])){
       array_push($_SESSION['errors'], "Article Category is Required.");
    }else{
      $articalCat = mysqli_real_escape_string($con,$_POST['articalCat']);  
    }

  

    if(empty($_POST['articleDesc'])){
       array_push($_SESSION['errors'], "Article Description is Required.");
    }else{
      $articleDesc = mysqli_real_escape_string($con,$_POST['articleDesc']);  
    }
    
    if( basename($_FILES["articleImg"]["name"] != "")){
        $target_dir = "uploads/";
        $timestamp = time();
        echo $target_file = $target_dir . $timestamp.'-'.basename($_FILES["articleImg"]["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["articleImg"]["tmp_name"]);
        if($check !== false) {
              
            if (file_exists($target_file)) {
                array_push($_SESSION['errors'], "Sorry, file already exists");
            }

            //Check file size
            if ($_FILES["articleImg"]["size"] > 50000000000) {
                array_push($_SESSION['errors'], "File is too large");
            }


           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                array_push($_SESSION['errors'], "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
                if (move_uploaded_file($_FILES["articleImg"]["tmp_name"], $target_file)) {
                  $articleImg = $target_file;

                } else {
                  array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
                }
            }        
          } else {
              array_push($_SESSION['errors'], "Please Upload Image File Only");
          }
          
        }else{
              array_push($_SESSION['errors'], "Please Upload Image File of article");
          
        }

     if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $sql= "INSERT INTO `tbl_articles` (`article_name` , `article_desc`, `article_img`,`cat_id`) VALUES ('$articleTitle', '$articleDesc', '$articleImg','$articalCat')";
    $result = mysqli_query($con,$sql);
    if($result){
      $_SESSION['successMsg'] = "Article has been added Successfully";
       header("location:addArticles.php");
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
         <h1 >Add Articles</h1>
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
          <div style="width: 40%; margin:auto;">
          <form action="addArticles.php" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-12">
            
            
               <div class="form-group">
                    <label for="exampleName">Select Category</label>
                    <select type="" class="form-control" id="articalCat" name="articalCat" aria-describedby="emailHelp" value=""> 
                      <option value="">Select Article Category</option>
                   <?php
                  $sql= "SELECT * FROM `tbl_articlescategory` WHERE `cat_status` = 'A' ORDER BY `cat_id`";
                   $result= mysqli_query($con,$sql);
                    if($result)
                    {
                     if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                          ?>
                          <option <?php if($articalCat == $row['cat_id']) {
                            echo "selected" ;} ?> value="<?php echo $row['cat_id']; ?>">
                           <?php echo $row['cat_name'];?> </option> 
                              
                      <?php
                        }
                      }
                    }
                    ?> 
                  </select>
                </div>
                
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleName">Enter Title</label>
                    <input type="text" class="form-control" id="" name="articleTitle" aria-describedby="emailHelp" value="<?php echo $articleTitle; ?>"> 
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                   <label for="exampleName">Image</label>
                          <div class="row">
                            <div class="col-md-12">
                              <input type="file" class="form-control" id="articleImg" name="articleImg" style="padding: 0 0 35px 0px;">
                              
                            </div>
                          </div>                          
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleName">Enter Description</label>
                    <!-- <input type="text" class="form-control" id="" name="articleDesc" aria-describedby="emailHelp" value="">  -->
                    <textarea class="form-control" rows="5" name="articleDesc"><?php echo $articleDesc; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                    
                    <input type="submit" name="addBtn" value="Submit" style="height:50px; width:90px;" type="button" class="btn btn-dark">
                </div>
              </div>
              
            </div>
          </form>
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
