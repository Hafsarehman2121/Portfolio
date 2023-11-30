<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">

<?php
$consultantID="";
require ('includes/head.php');
$consultantID=$_SESSION['userID'];
?>
<body>
<div class="loader loader-bg">
  <div class="loader-inner ball-clip-rotate-pulse">
    <div></div>
    <div></div>
  </div>
</div>

<?php
require ('includes/topNav.php'); 
?>
    



<!-- About 
    ================================================== -->
<section class="about-sec parallax-section" id="about">
  
    <div style="width: 70%; margin:auto;">
      <div class="col-md-12">
        <br>
        <h3 style="text-center">Chat With Clients</h3>
        
      </div>
      
      <br>
      <div class="col-md-12">
        <?php if(isset($_SESSION['errorMsg'])){
          ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['errorMsg']; unset($_SESSION['errorMsg']); ?>
          </div>
          <?php
        } ?>

        <?php if(isset($_SESSION['successMsg'])){
          ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']); ?>
          </div>
          <?php
        } ?>
        
        <table  id="example" class="table table-striped custab">
                                    <thead>
                                        <tr>
                                            <th>Sr.NO</th>
                                            <th>Client Name</th>
                                            <th>Chat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $sql = "SELECT DISTINCT (`sender_id`) as clientID FROM `tbl_chat` WHERE `receiver_id` = '$consultantID' ORDER BY `chat_id` DESC";
                                      $result = mysqli_query($con,$sql);
                                        if($result){
                                          $srNo = 1;
                                          while ($row = mysqli_fetch_array($result)) {
                                              ?>
                                           <tr>
                                              <td class="align-middle"><?php echo $srNo; ?></td>
                                              <td>
                                                <?php echo getUserName($row['clientID']); ?>
                                              </td>
                                             
                                             <td><a class='btn btn-danger btn-xs' href="showUserProfile.php?clientID=<?php echo $row['clientID']; ?>&consultantID=<?php echo $consultantID; ?>"><span class="fa fa-comments-o"></span> Chat <?php if (getChatNotifications($row['clientID'],$consultantID) > 0 ) { ?>
                                             <span class="badge badge-light"><?php echo getChatNotifications($row['clientID'],$consultantID); ?>
                                             </span> 
                                             <?php } ?></a></td>
                                         
                                      </tbody>
                                  <?php
                                        $srNo++;
                                    }
                                  }
                                 ?>

                                </table>
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
