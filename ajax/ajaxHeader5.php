<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);

	$a = 0;
	$b = 0;

	// Displaying unread notifications first
	$sql = "SELECT * FROM communication WHERE receiverID=$id";
	$result = $con->query($sql);

	$div = '';

	if($result->num_rows > 0){
		$a = 1;
		while($row = $result->fetch_assoc()){
			$senderID = $row['senderID'];
			// Getting receiver's data
			$sql1 = "SELECT * FROM users WHERE id=$senderID";
			$result1 = $con->query($sql1);
			$profilePic = "";
			$username = "";
			while($row1 = $result1->fetch_assoc()) {
				$profilePic .= $row1['image'];
				$username = $row1['username'];
			}
			if($profilePic == ""){
				$profilePic = "img/16.jpg";
			}

			// Getting no. of messages
			$sql2 = "SELECT * FROM messages WHERE receiverID=$id AND uid=$senderID AND status=0";
			$result2 = $con->query($sql2);
			$n = 0;
			$daetime = '';
			if($result2->num_rows > 0){
				while($row2 = $result2->fetch_assoc()){
					$datetime = $row2['datetime'];
					$n++;
				}
			}
			if($n != 0){
				$b = 1;
				$div .= '
					<input type="hidden" name="id" id="id" value='.$id.'>
                    <input type="hidden" name="id1" id="id1" value='.$senderID.'>
                    <div class="row vertical-align">
						<div class="col-md-2">
						<img src="'.$profilePic.'" style="height: 55px; width: 57px; object-fit:cover;" class="rounded-circle">
						</div>
						<div class="col-md-8">
						<div style="margin-top: 5px;">
						';
						if($n == 1){
							$div .= '
								<a href="profile.php?id='.$id.'"><b>'.$username.'</b></a> sent you a message.
							';
						}else{
							$div .= '
								<a href="profile.php?id='.$id.'"><b>'.$username.'</b></a> sent you '.$n.' messages.
							';
						}
					$div .= '
						</div>
						<p style="font-size: 11px; color: red; font-weight: 450;">'.$datetime.'</p>
						</div>
						<div class="col-md-2" style="margin-left: -12px;">
						</div>
					</div>
                    <a id="msg" name="msg" class="btn" style="position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 100%; border: none; cursor: pointer;" href="message.php?id1='.$senderID.'"></a>
				';
			}else{
				$b = 0;
			}
		}
	}else{
		$a = 0;
	}
	if($a == 0 || $b == 0){
		$div .= '
			<h5 style="font-family: cursive;">No New Messages!</h5>
		';
	}

	echo $div;

?>