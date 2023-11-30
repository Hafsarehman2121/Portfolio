<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link href="css/custom1.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		
		<?php 
		$sql = "SELECT * FROM `tbl_chat`  WHERE 
		        (`sender_id` ='$senderID' and `receiver_id` = '$receiverID')
		        OR
		        (`receiver_id` = '$senderID' and `sender_id` = '$receiverID')";


		        $result=mysqli_query($con,$sql);

		        $countMessages = mysqli_num_rows($result);

		?>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
					 
				<div class="col-md-12 col-xl-12 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with <?php echo $consultantName; ?></span>
									<p><?php echo $countMessages; ?> Messages</p>
								</div>
								
							</div>
							<!-- <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div> -->
						</div>
						<div id="chatDiv" class="card-body msg_card_body">
							<?php 

							
                            $n=1;
                            while($row=mysqli_fetch_assoc($result))
                            {
                            	if($row['sender_id'] == $senderID){
                                   //  $class = "senderMsg";
                                   // $userName = $_SESSION['m_fullname'];
                                    $userImage = getUserProfileImage($senderID);
                                    if($userImage == "" OR !file_exists($userImage)){
                                       $userImage = "https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg";
                                     }
                                    $msgDivClass = "justify-content-end";

                                     
                                }

                                if($row['receiver_id'] == $senderID){
                                    // $class = "receiverMsg";
                                    // $userName = getUserName($receiverID);
                                     $userImage = "https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg";
                                    $msgDivClass = "justify-content-start";
                                    
                                }
                                ?>
                                <input type="hidden" id="senderID_input" value="<?php echo $senderID; ?>">
		                          <input type="hidden" id="receiverID_input" value="<?php echo $receiverID; ?>">
                                <div class="d-flex <?php echo $msgDivClass; ?>  mb-4">
                                	<?php 
                                		if($row['receiver_id'] == $senderID){

                                	?>
										<div class="img_cont_msg">
											<img src="<?php echo $userImage; ?>" class="rounded-circle user_img_msg">
										</div>
									<?php 

									$class = "msg_cotainer";
									}else{
										$class = "msg_cotainer_send";
									} ?>
									<div class="<?php echo $class; ?>">
										<?php echo $row['chat_msg']; ?>
										<span class="msg_time"><?php echo $row['chat_time']; ?></span>
									</div>


									<?php 

			                            if($row['sender_id'] == $senderID){

									 ?>

										<div class="img_cont_msg">
											<img src="<?php echo $userImage; ?>" class="rounded-circle user_img_msg">
										</div>

									<?php } ?>
								</div>
                                <?php

                            }

                            ?>
							
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<input type="text"name="" id="msg" class="form-control type_msg" placeholder="Type your message...">
								<div class="input-group-append">
									<span class="input-group-text send_btn" onclick="sendMsg(<?php echo $senderID; ?>,<?php echo $receiverID; ?>);"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>