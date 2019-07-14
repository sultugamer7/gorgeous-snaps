<?php
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$username = $_GET['username'];
	$fromDate = $_GET['fromDate'];
	$toDate = $_GET['toDate'];

	// Escape User Input to help prevent SQL Injection
	$username = mysqli_real_escape_string($con,$username);
	$fromDate = mysqli_real_escape_string($con,$fromDate);
	$toDate = mysqli_real_escape_string($con,$toDate);

	// Converting dates to MySQL format
	$fromDate1 = date("Y-m-d H:i:s", strtotime($fromDate)); 
	$toDate1 = date("Y-m-d H:i:s", strtotime($toDate. ' + 1 day'));

	$sql = '';
	if($username != ''){
		$sql = "SELECT * FROM notifications WHERE uid IN (SELECT id FROM users WHERE username LIKE '$username%') AND datetime BETWEEN '$fromDate1' AND '$toDate1' ORDER BY datetime DESC";
	}else{
		$sql = "SELECT * FROM notifications WHERE datetime BETWEEN '$fromDate1' AND '$toDate1' ORDER BY datetime DESC";
	}
	
	$notifications = '';

	$i = 0;
	$notificationID = array();
	$uid1 = array();
	$followerID = array();
	$likerID = array();
	$commenterID = array();
	$postID = array();

	$result = $con->query($sql);
	if($result->num_rows > 0){
		$notifications .= '
			<div class="panel-body" style="overflow-y: scroll; margin-left: -31px; width: 676.5px; height: 400px; margin-top: -16px;">
			<div class="row vertical-align" style="margin-top: 16px; margin-left: -1px; width: 634px; margin-left: 25px;">
		';
		while($row = $result->fetch_assoc()){
			// Getting values
			$notificationID[$i] = $row['notificationID'];
			$uid1[$i] = $row['uid'];
			$postID[$i] = $row['postID'];
			$notificationType = $row['notificationType'];
			$likerID[$i] = $row['likerID'];
			$commenterID[$i] = $row['commenterID'];
			$followerID[$i] = $row['followerID'];
			$datetime = $row['datetime'];

			// Displaying notifications

			// Like notifications
			if($notificationType == 'Like'){
			    // Getting username and profile pic of notifier
			    $sql2 = "SELECT * FROM users WHERE id=$likerID[$i]";
			    $result2 = $con->query($sql2);
			    while($row2 = $result2->fetch_assoc()){
			        $profilepic8 = '../'.$row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == '../'){
					$profilepic8 = 'img/16.jpg';
				}

				// Getting username and profile pic of user who is notified
				$sql3 = "SELECT * FROM users WHERE id=$uid1[$i]";
			    $result3 = $con->query($sql3);
			    while($row3 = $result3->fetch_assoc()){
			        $profilepic9 = '../'.$row3['image'];
					$username9 = $row3['username'];
				}
				if($profilepic9 == '../'){
					$profilepic9 = 'img/16.jpg';
				}

				// Getting the post
				$sql2 = "SELECT * FROM posts WHERE id=$postID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$post = '../'.$row2['image'];
				}

				$notifications .= "
					<div class='col-md-2'>
						<center>
							<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle shadow'>
						</center>
					</div>
					<div class='col-md-5' style='padding-left: 0px; margin-left: -15px; margin-top: 3px;'>
					";
					if($username8 == $username9){
						$notifications .= "
							<a href='profile.php?id=".$likerID[$i]."'><b>$username8</b></a>
							 liked his own post.
							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
						";
					}else{
						$notifications .= "
							<a href='profile.php?id=".$likerID[$i]."'><b>$username8</b></a>
							 liked 
							<a href='profile.php?id=".$uid1[$i]."'><b>".$username9."</b></a>'s
							 post.
							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
						";
					}
					
					$notifications .= "
					</div>
					<div class='col-md-5' style='margin-left: -12px; height: 108px;'>
						<img src='$profilepic9' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle shadow'>
						 ❤️ 
						<a href='details.php?id=".$postID[$i]."&id0=".$uid1[$i]."'><img src=$post style='height: 86px; width: 100px; object-fit: cover; border-style: double; height: 100px; width: 114px;' class='shadow'></a>
					</div>
					<div style='height: 100px;'></div>
				";
			}

			if($notificationType == 'Comment'){
				// Getting username and profile pic of notifier
				$sql2 = "SELECT * FROM users WHERE id=$commenterID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$profilepic8 = '../'.$row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == '../'){
					$profilepic8 = 'img/16.jpg';
				}

				// Getting username and profile pic of user who is notified
				$sql3 = "SELECT * FROM users WHERE id=$uid1[$i]";
			    $result3 = $con->query($sql3);
			    while($row3 = $result3->fetch_assoc()){
			        $profilepic9 = '../'.$row3['image'];
					$username9 = $row3['username'];
				}
				if($profilepic9 == '../'){
					$profilepic9 = 'img/16.jpg';
				}

				// Getting the post
				$sql2 = "SELECT * FROM posts WHERE id=$postID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$post = '../'.$row2['image'];
				}

				$notifications .= "
					<div class='col-md-2'>
						<center>
							<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle shadow'>
						</center>
					</div>
					<div class='col-md-5' style='padding-left: 0px; margin-left: -15px; margin-top: 3px;'>
					";
					if($username8 == $username9){
						$notifications .= "
							<a href='profile.php?id=".$commenterID[$i]."'><b>$username8</b></a>
							 commented on his own post.
							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
						";
					}else{
						$notifications .= "
							<a href='profile.php?id=".$commenterID[$i]."'><b>$username8</b></a>
							 commented on 
							<a href='profile.php?id=".$uid1[$i]."'><b>".$username9."</b></a>'s
							 post.
							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
						";
					}
					
					$notifications .= "
					</div>
					<div class='col-md-5' style='margin-left: -12px; height: 108px;'>
						<img src='$profilepic9' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle shadow'>
						 💬 
						<a href='details.php?id=".$postID[$i]."&id0=".$uid1[$i]."'><img src=$post style='height: 86px; width: 100px; object-fit: cover; border-style: double; height: 100px; width: 114px;' class='shadow'></a>
					</div>
				";
			}

			if($notificationType == 'Follow'){
				// Getting username and profile pic of notifier
				$sql2 = "SELECT * FROM users WHERE id=$followerID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$profilepic8 = '../'.$row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == '../'){
					$profilepic8 = 'img/16.jpg';
				}

				// Getting username and profile pic of user who is notified
				$sql3 = "SELECT * FROM users WHERE id=$uid1[$i]";
			    $result3 = $con->query($sql3);
			    while($row3 = $result3->fetch_assoc()){
			        $profilepic9 = '../'.$row3['image'];
					$username9 = $row3['username'];
				}
				if($profilepic9 == '../'){
					$profilepic9 = 'img/16.jpg';
				}

				$notifications .= "
					<div class='col-md-2'>
						<center>
							<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle shadow'>
						</center>
					</div>
					<div class='col-md-5' style='padding-left: 0px; margin-left: -15px; margin-top: 3px;'>
						<a href='profile.php?id=".$followerID[$i]."'><b>$username8</b></a>
						 started following  
						<a href='profile.php?id=".$uid1[$i]."'><b>".$username9."</b></a>.
						<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
					</div>
					<div class='col-md-5' style='margin-left: -12px; height: 70px;'>
						<img src='$profilepic9' style='height: 55px; width: 57px; object-fit:cover; margin-top: 4px;' class='rounded-circle shadow'>
					</div>
			    ";
			}

			$i++;
		}
		$notifications .= "
			</div>
		</div>
		";
	}else{
		$notifications .= "
			Activity not found!
		";
	}

	echo $notifications;

?>