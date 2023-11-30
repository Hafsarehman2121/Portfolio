<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 

if(isLogin() == false){
  header("location:userLogIn.php");
  exit();
}


?>

<body>

<?php
require ('includes/topNav.php'); 
?>
    



<!-- About 
    ================================================== -->
<section class="abc " >
  <div class="container1">
    <div class="row1">
      <div class="col-md-4 col-sm-6 text-center">
         <div class="box">
           <div class="box-content">
              <h3 class="title"> My Appointments</h3>
              <span><i class="fa fa-phone" aria-hidden="true"></i></span>
              <div class="butt">
             <a href="myAppointments.php"> <button>Click Here</button></a>
              </div>
            </div>
          </div>
      </div>
       
        
      </div>
       <div class="col-md-4 col-sm-6 text-center">
         <div class="box1">
           <div class="box-content">
            <h3 class="title">Articles
            </h3>
            <span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
              <div class="butt">
             <a href=""> <button >Click Here</button></a>
              </div>
           </div>
         </div>
      </div>
      <div class="col-md-4 col-sm-6 text-center">
         <div class="box2">
           <div class="box-content">
            <h3 class="title">Videos
            </h3>
            <span><i class="fa fa-users" aria-hidden="true"></i></span>
             <div class="butt">
              <button>Click Here</button>
              </div>      
           </div>
         </div>
        
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
