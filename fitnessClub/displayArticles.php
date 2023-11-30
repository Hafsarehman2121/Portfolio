   <!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
?>
<body>


<?php
require ('includes/topNav.php'); 
 $whereClasue = " WHERE `article_status`='A' ";
$articleTitle = "";
if (isset($_POST['serachBtn'])) {
  $articleTitle = mysqli_real_escape_string($con,$_POST['articleTitle']);
  $whereClasue .= " AND `article_name` LIKE '%$articleTitle%' ";
}

?>
    
<br>





<!-- BLOG
    ================================================== -->

<section class="blog-sec" id="blog">
  <br>
  
  
  <div class="container">
    
      <div class="row" >
          <div class="col-md-12" >
              <div class="heading text-md-center text-xs-center">
      
                       <h2 style="color:black; font-style: sans-serif;">Articles</h2>
      <br>
       <div style="" class="row">
           <form style="background-color: white; border: none;" action="displayArticles.php" method="POST">
               <div class="input-group">

                  <div id="search-autocomplete" class="form-outline">
                      <input style="width:500px; height:50px; margin-left:300px;" type="search" id="form1" name="articleTitle" class="form-control" value="" placeholder="Search By Article Title" />
            
                  </div>
                    <button type="submit" name="serachBtn" class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </button>
                </div>

            </form>

         </div>
    </div>
    
    <div class="row" style="background-color: lightgray; width:100%; padding-left: 0px;">
<?php
   
       $sql = "SELECT * FROM `tbl_articles` ".$whereClasue;
       $result = mysqli_query($con,$sql); 
       if($result){
        if (mysqli_num_rows($result)>0) {
          while ($row = mysqli_fetch_array($result)) {
            $articleImage = "admin/".$row['article_img'];

       ?>
      <div class="col-md-4 blog-box mb-4" >
        <div class="blog-image" style="padding-top:10px;"> 
          <?php if ($articleImage != "admin/" && file_exists($articleImage)) {
            ?>
            <img src="<?php echo $articleImage; ?>" style="width: 150%; height:200px;" alt="" class="img-fluid">
            <?php
          }else{
            ?>
            <img src="img/user1.jpg" alt="" class="img-fluid">
            <?php  
          } ?>
          
        </div>

        <div style="background-color:white; height: 180px; margin-top:2px;">
        <h3 class="blog-title" style="color: black; font-style: sans-serif;"><b><?php echo $row['article_name']; ?></b><a href=""></a></h3>
        <p class="blog-content"><a href="articlesDetail.php?artID=<?php echo $row['article_id'];?>">

          
          <?php $desc= $row['article_desc']; 
          $length = strlen($desc);
          if($length>100){
            echo substr($desc, 0,99)."...";
          }else{
            echo $desc;
          }

          ?>
        </a></p>
        </div>
       

      </div>
    <?php 
      } 
      }else{
        ?>
        <div class="alert alert-info">No Article(s) Found</div>
        <?php
      }
      }
    ?>


     </div>
    </div>
  </div>
  
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
