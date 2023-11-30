   <?php ob_start();?>
   <!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
$articleID= $articleDesc=$articleImage=$articleName=$comment=$userType=$consType=
$commentUser=$commentMsg=$userName="";
$userID=$_SESSION['userID'];

if(isset($_SESSION['userType'])){

$userType=$_SESSION['userType']; 
}
?>
<body>


<?php
require ('includes/topNav.php'); 
 if(isset($_GET['artID']))
 {
  $articleID = $_GET['artID'];
  $sql = "SELECT * FROM `tbl_articles`  WHERE `article_id` = '$articleID'";
  $result = mysqli_query($con,$sql);
  
  if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $articleName = $row['article_name'];
        $articleImage = "admin/".$row['article_img'];
        $articleDesc = $row['article_desc'];

        
      }
}
}

 if(isset($_POST['post'])){
  if(empty($_POST['msg'])){
       array_push($_SESSION['errors'], "Please Enter Your Comment.");
    }else{
      $comment = mysqli_real_escape_string($con,$_POST['msg']);  
    }

    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      $sql="INSERT INTO `tbl_comment` (`comment_userID`,`comment_art_ID`,`comment_msg`,`commentBy`) VALUES('$userID','$articleID','$comment','$userType')";
      $result = mysqli_query($con,$sql);
      if($result){
        $_SESSION['successMsg'] = "";
      header("location:articlesDetail.php");
      exit();
      }
    }
}


?>
    






<!-- BLOG
    ================================================== -->

<section class="blog-sec" id="blog">
    <br>
     <br>
     <br>
     <br>       
  <div class="container">
   
      <div class="row">
          <div class="col-md-12">

    <div class="heading text-md-center text-xs-center">
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
            

      <h2 style="color: black; font-style:sans-serif;"><?php echo $articleName ?></h2>
      
      

    </div>
    </div>
    </div>
    <div class="row">

      
        <div class="blog-image-block"> 
          <?php if ($articleImage != "admin/" && file_exists($articleImage)) {
            ?>
            <img src="<?php echo $articleImage; ?>" style="width: 1200px; height:600px; margin-left:0px;" alt="" class="img-fluid">
            <?php
          }
          ?>
          
        </div>
</div>
       
        <p class="blog-content">
          
          <?php echo $articleDesc ?>
        </p>
        </div>
        <br>
        <br>
        <div class="row">
          <h1 style="margin-left: 500px; color: black;"><a href="userLogIn.php">Sign In</a> To  Share your Views</h1>
        </div>
       

     
  <!--Comment Section -->  

<!-- Main Body -->
<section>
    <div class="container">
        <div class="row">
         
          
            <div class="col-sm-5 col-md-6 col-12 pb-4">
              <h1 style="color:black;">Comments</h1>
               <?php
          $sql="SELECT * FROM `tbl_comment` WHERE `comment_art_ID`='$articleID'";
          $result = mysqli_query($con,$sql); 
           if($result){
               if (mysqli_num_rows($result)>0) {
                 while ($row = mysqli_fetch_array($result)) {
                   
                   $commentUser = $row['comment_userID'];
                   $commentMsg = $row['comment_msg'];
                   $consType = getConsultType($commentUser);
                   ?>
                   <?php
                 //  $sql2 ="SELECT * FROM `tbl_consultants` WHERE `cons_id`= '$commentUser'";
                //   $result = mysqli_query($con,$sql); 
                 //   if($result){
                 //   if (mysqli_num_rows($result)>0) {
                 //       $consType= $row['cons_type'];
                  ?> 
                   <div class="comment mt-4 text-justify float-left">
                 
                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4><?php if($consType=='GT' || $consType=='N'){ echo getConsultName($commentUser);}
                    else{echo getUserName($commentUser);}

                    ?></h4>
                    <span>- 20 October, 2018</span>
                    <br>
                    <p><?php echo $commentMsg ?></p>
                
                </div>
                <?php
                  }
                }
              }
           
       ?>   
            </div>
            <?php if(isLogin() == true){ ?>
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="algin-form" action="articlesDetail.php?artID=<?php echo $articleID ?>" method="post">
                    <div class="form-group">
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
                   
                        <h4>Leave a comment</h4>
                        <label for="message">Message</label>
                        <textarea name="msg" id=""msg cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" name="post" id="post" value="Post Comment" class="btn">
                    </div>
                   
                </form>
            </div>
            <?php 
                  }
                  ?>
        </div>
    </div>
</section>
    
</section>



<?php
require ('includes/footer.php'); 
?>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery.min.js" ></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/scrollPosStyler.js"></script> 
<script src="js/swiper.min.js"></script> 
<script src="js/isotope.min.js"></script> 
<script src="js/nivo-lightbox.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/core.js"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
