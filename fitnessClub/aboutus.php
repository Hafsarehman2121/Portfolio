<!DOCTYPE html>
<html lang="en">
<?php
require ('includes/head.php'); 
?>
<body>

<?php
require ('includes/topNav.php'); 
?>
    
<!-- Swiper Silder
    ================================================== --> 
<!-- Slider main container -->
<div class="swiper-container main-slider" id="myCarousel">
  <div class="swiper-wrapper">
    <div class="swiper-slide slider-bg-position" style="background:url('img/4.jpg')" data-hash="slide1">
     
      <h2>Our goal is to make health and fitness attainable, affordable and approachable.</h2>
    </div>
   
  </div>
  
  
</div>



<!-- Benefits
    ================================================== -->
<section class="service-sec" id="benefits">
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="heading text-md-center text-xs-center">
      <h2><small>Benefits of Exercise</small>To enjoy the glow of good health, you must exercise</h2>
    </div>
        </div>
      <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-plus" aria-hidden="true"></i>
          <h3>Better Sleep</h3>
          <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe.</p>
        </div>
        <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
          <h3>Reduces Weight</h3>
          <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe.</p>
        </div>
        <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-leaf" aria-hidden="true"></i>
          <h3>Improves Mood</h3>
          <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe.</p>
        </div>
        <div class="col-md-6 text-sm-center service-block"> <i class="fa fa-bell" aria-hidden="true"></i>
          <h3>Boosts Energy</h3>
          <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe.</p>
        </div>
        </div>
      </div>
      <div class="col-md-4"> <img src="img/side-01.jpg" class="img-fluid" /> </div>
    </div>
    <!-- /.row --> 
  </div>
</section>

<!-- About 
    ================================================== -->
<section class="about-sec parallax-section" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2><small>Who We Are</small>About<br>
          Our Blog</h2>
      </div>
      <div class="col-md-4">
        <p>To enjoy good health, to bring true happiness to one's family, to bring peace to all, one must first discipline and control one's own mind. If a man can control his mind he can find the way to Enlightenment, and all wisdom and virtue will naturally come to him.</p>
        <p>Saving our planet, lifting people out of poverty, advancing economic growth... these are one and the same fight. We must connect the dots between climate change, water scarcity, energy shortages, global health, food security and women's empowerment. Solutions to one problem must be solutions for all.</p>
      </div>
      <div class="col-md-4">
        <p>Our greatest happiness does not depend on the condition of life in which chance has placed us, but is always the result of a good conscience, good health, occupation, and freedom in all just pursuits.</p>
        <p>Being in control of your life and having realistic expectations about your day-to-day challenges are the keys to stress management, which is perhaps the most important ingredient to living a happy, healthy and rewarding life.</p>
        <p><a href="#" class="btn btn-transparent-white btn-capsul">Explore More</a></p>
      </div>
    </div>
  </div>
</section>


<section class="" id="contact">
  <div class="container">
    <h2 style="text-align:center;">Get in Touch<br> <small>Our work is the presentation of our capabilities.</small> </h2>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleName">Name</label>
          <input type="text" class="form-control" id="exampleName" aria-describedby="emailHelp">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="examplePhone">Phone Number</label>
          <input type="text" class="form-control" id="examplePhone" aria-describedby="emailHelp">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> </div>
      </div>
      <div class="col-md-12">
        <label for="exampleTextarea">Enter your Message</label>
        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
      </div>
      <div class="col-md-12 text-xs-center action-block"> <a href="#" class="btn btn-capsul btn-aqua">Submit</a> </div>
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
