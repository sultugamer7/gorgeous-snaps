<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$receiverID = $_GET['receiverID'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$receiverID = mysqli_real_escape_string($con,$receiverID);

	$sql5 = "UPDATE messages SET status=1 WHERE uid=$receiverID AND receiverID=$id";
	$con->query($sql5);

	// Getting texter's data
	$sql = "SELECT * FROM users WHERE id=$receiverID";
	$result = $con->query($sql);
	$profilePic = '';
	$username = '';
	while($row = $result->fetch_assoc()){
		$profilePic .= $row['image'];
		$username = $row['username'];
	}
	if($profilePic == ''){
		$profilePic = 'img/16.jpg';
	}

	$div1 = '';

					$sql = "SELECT * FROM messages WHERE uid=$id AND receiverID=$receiverID OR uid=$receiverID AND receiverID=$id ORDER BY id";
					$result = $con->query($sql);
					if ($result->num_rows < 0) {
						$div1 .= '
							<div class="row">
								<div class="col-md-10">
									No messages
								</div>
								<div class="col-md-2">
								</div>
							</div>
						';
					}else{
						while($row = $result->fetch_assoc()){
							$uid = $row['uid'];
							$receiverID1 = $row['receiverID'];
							$messageData = $row['messageData'];
							$datetime = $row['datetime'];
							$div1 .= '
								<div class="row" style="margin-top: 10px;">
									<div class="col-md-1">
										<center>
							';
										if($uid != $id){
											$div1 .= '
												<a href="#" style="font-size: 14px;">'.$username.': </a>
											';
										}else{
											$div1 .= '
												<label style="color: red; font-size: 14px;">You: </label>
											';
										}
									$div1 .= '
										</center>
									</div>

									<div class="col-md-8">
										<label style="font-size: 14px;">'.$messageData.'</label>
									</div>
									<div class="col-md-3">
										<center style="font-size: 10px; color: red;">'.$datetime.'</center>
									</div>
								</div>
							';
						}
						
					}

	echo $div1;

?>