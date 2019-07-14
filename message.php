<?php
	include "database.php";

	

	if(isset($_POST['msg'])) {

		$id = $_POST['id'];
		$id1 = $_POST['id1'];
		$sql2 = "SELECT * FROM communication WHERE senderID=$id AND receiverID=$id1";
		$result = $con->query($sql2);
		if($result->num_rows == 0){
			$sql = "INSERT INTO communication(senderID, receiverID) VALUES($id,$id1)";
			$sql1 = "INSERT INTO communication(senderID, receiverID) VALUES($id1,$id)";
			if($con->query($sql) == TRUE && $con->query($sql1) == TRUE){
				echo '
				<script>
				window.location.href="message.php?id1='.$id1.'";
				</script>
				';
			}
		}else{
			echo '
			<script>
			window.location.href="message.php?id1='.$id1.'";
			</script>
			';
		}
	}
?>
<html>

	<head>

		<!-- Title -->
		<title>Message | Gorgeous Snaps</title>

		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="styles/message.css">

	</head>

	<body class="bodycolor">

		<!-- Header -->
		<?php
			include("header.php");
			include("getdata.php");
		?>

		<!-- Top space -->
		<div class="top">
		</div>

		<!-- Container -->
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<!-- Jumbotron for displaying purpose -->
					<div class="jumbotron" style="padding-top: 16px;">
						<!-- Row for displaying user's profile and a link to user's profile -->
						<div class="row">
							<!-- Getting receiver's data -->
							<?php

								$receiverID = $_GET['id1'];
								
								$sql = "SELECT * FROM users WHERE id=$receiverID";
								$result = $con->query($sql);
								$profilePic = '';
								$username = '';
								while($row = $result->fetch_assoc()){
									$profilePic = $row['image'];
									$username = $row['username'];
								}
								if($profilePic == ''){
									$profilePic = 'img/16.jpg';
								}
								
							?>
							<img src="<?php echo $profilePic;?>" style="height: 50px; width: 53px; object-fit: cover;" class="rounded-circle shadow">
							<a href="profile.php?id=<?php echo $receiverID;?>" style="margin-top: 10px; margin-left: 10px;"><?php echo $username;?></a>
						</div>
						<!-- ID's to pass to AJAX -->
						<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
						<input type="hidden" name="receiverID" id="receiverID" value="<?php echo $receiverID;?>">
						<hr>
						<div class="panel-body" id="Box" style="overflow-y: auto; display: flex; flex-direction: column-reverse; height: 325px; border-style: double;">
							<div class="mid-width wrapItems" style="margin-left: 10px; margin-top: 5px;">
								<div id="Test2" width="100%">
									<div class="container">
										<div id="message1">
										</div>
										
										<div id="bottom" style="height: 10px;"></div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-10">
								<input type="text" id="messageData" class="form-control form-control-sm" maxlength="100" autocomplete="off">
							</div>
							<div class="col-md-2">
								<input type="button" name="send" id="send" value="Send" class="btn btn-primary btn-sm" style="width: 85px;" onclick="ajaxMessage2();">
							</div>
							
							<script language = "javascript" type = "text/javascript">
						        <!-- 
						        var id = document.getElementById('id').value;
						        var receiverID = document.getElementById('receiverID').value;

						        // AJAX for displaying messages
								function ajaxMessage1() {
						            var ajaxRequest;  // The variable that makes Ajax possible!
						            try {        
						               	// Opera 8.0+, Firefox, Safari
						               	ajaxRequest = new XMLHttpRequest();
						            } catch (e) {
										// Internet Explorer Browsers
						               	try {
						               		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
						               	} catch (e) {
							               	try {
							               		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							               	} catch (e) {
							                     // Something went wrong
							                     alert("Your browser broke!");
							                     return false;
							                }
						                }
						            }
						            // Create a function that will receive data
						            // sent from the server and will update
						            // div section in the same page.
						            ajaxRequest.onreadystatechange = function() {
						            	if(ajaxRequest.readyState == 4) {
						            		var ajaxDisplay = document.getElementById('message1');
						            		ajaxDisplay.innerHTML = ajaxRequest.responseText;
						            		
						            	}
						           	}
						            // Now get the value from user and pass it to
						           	// server script.
						            ajaxRequest.open("GET", "ajax/ajaxMessage1.php?id="+id+"&receiverID="+receiverID, true);
						            ajaxRequest.send(null); 
						        }

						        // AJAX for sending messages
								function ajaxMessage2() {
									var messageData = document.getElementById('messageData').value;
									if(messageData == ''){
										alert("No Message Typed...");
										return false;
									}
						            var ajaxRequest;  // The variable that makes Ajax possible!
						            try {        
						               	// Opera 8.0+, Firefox, Safari
						               	ajaxRequest = new XMLHttpRequest();
						            } catch (e) {
										// Internet Explorer Browsers
						               	try {
						               		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
						               	} catch (e) {
							               	try {
							               		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							               	} catch (e) {
							                     // Something went wrong
							                     alert("Your browser broke!");
							                     return false;
							                }
						                }
						            }
						            // Create a function that will receive data
						            // sent from the server and will update
						            // div section in the same page.
						            ajaxRequest.onreadystatechange = function() {
						            	if(ajaxRequest.readyState == 4) {
						            		ajaxMessage1();
						            		var messageData = document.getElementById('messageData');
						            		messageData.value = '';
						            		var element = document.getElementById("Box");
		        							element.scrollTop = element.scrollHeight;
						            	}
						           	}
						            // Now get the value from user and pass it to
						           	// server script.
						            ajaxRequest.open("GET", "ajax/ajaxMessage2.php?id="+id+"&receiverID="+receiverID+"&messageData="+messageData, true);
						            ajaxRequest.send(null); 
						        }
						        //-->
						    </script>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<br/><br/>

    <!-- Footer -->
    <?php
      include("footer.php");
    ?>
	</body>
</html>

<script>
	$(document).ready(function(){
		ajaxMessage1();
		setInterval(function(){ajaxMessage1();},500);
	});
</script>
