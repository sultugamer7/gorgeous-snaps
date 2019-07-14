<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);

	// Displaying unread notifications first
	$sql = "SELECT * FROM notifications WHERE uid=$id AND notificationStatus!=2 ORDER BY notificationID DESC LIMIT 30";
	$result = $con->query($sql);
	$i = 0;
	$notificationID = array();
	$followerID = array();
	$likerID = array();
	$commenterID = array();
	$postID = array();

	$div = '';

	if($result->num_rows > 0){

		while($row = $result->fetch_assoc()){
			// Getting values
			$notificationID[$i] = $row['notificationID'];
			$postID[$i] = $row['postID'];
			$notificationType = $row['notificationType'];
			$likerID[$i] = $row['likerID'];
			$commenterID[$i] = $row['commenterID'];
			$followerID[$i] = $row['followerID'];
			$datetime = $row['datetime'];

			// Displaying notification
			if($notificationType == 'Like'){
				// Getting username and profile pic
				$sql2 = "SELECT * FROM users WHERE id=$likerID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$profilepic8 = $row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == ''){
					$profilepic8 = 'img/16.jpg';
				}

				// Getting the post
				$sql2 = "SELECT * FROM posts WHERE id=$postID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$post = $row2['image'];
				}

				$div .= "
					<div class='row vertical-align'>
					<div class='col-md-2'>
					<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle'>
					</div>
					<div class='col-md-8'>
					<div style='margin-top: 5px;'>
					<a href='profile.php?id=$likerID[$i]'><b>$username8</b></a> liked your post.
					</div>
					<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
					</div>
					<div class='col-md-2' style='margin-left: -12px;'>
					<img src='$post' style='height: 55px; width: 60px; object-fit:cover;'>
					</div>
					</div>
					<input type='button' class='btn' style='position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 100%; border: none; cursor: pointer;' value='' name='likeNotification$i' onclick='ajaxHeader6($postID[$i]);'>
				";
			}

			if($notificationType == 'Comment'){
				// Getting username and profile pic
				$sql2 = "SELECT * FROM users WHERE id=$commenterID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$profilepic8 = $row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == ''){
					$profilepic8 = 'img/16.jpg';
				}

				// Getting the post
				$sql2 = "SELECT * FROM posts WHERE id=$postID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$post = $row2['image'];
				}

				$div .= "
				<div class='row vertical-align'>
				<div class='col-md-2'>
				<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle'>
				</div>
				<div class='col-md-8'>
				<div style='margin-top: 5px;'>
				<a href='profile.php?id=$commenterID[$i]'><b>$username8</b></a> commented on your post.
				</div>
				<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
				</div>
				<div class='col-md-2' style='margin-left: -12px;'>
				<img src='$post' style='height: 55px; width: 60px; object-fit:cover;'>
				</div>
				</div>
				<input type='button' class='btn' style='position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 100%; border: none; cursor: pointer;' value='' name='commentNotification$i' onclick='ajaxHeader6($postID[$i]);'>
				";
			}

			if($notificationType == 'Follow'){
				// Getting username and profile pic
				$sql2 = "SELECT * FROM users WHERE id=$followerID[$i]";
				$result2 = $con->query($sql2);
				while($row2 = $result2->fetch_assoc()){
					$profilepic8 = $row2['image'];
					$username8 = $row2['username'];
				}
				if($profilepic8 == ''){
					$profilepic8 = 'img/16.jpg';
				}
				$div .= "
				<div class='row vertical-align'>
				<div class='col-md-2'>
				<img src='$profilepic8' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle'>
				</div>
				<div class='col-md-8'>
				<div style='margin-top: 5px;'>
				<a href='profile.php?id=$followerID[$i]'><b>$username8</b></a> started following you.
				</div>
				<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
				</div>
				<div class='col-md-2'>

				</div>
				</div>
				<input type='button' class='btn' style='position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 100%; border: none; cursor: pointer;' value='' name='followerNotification$i' onclick='ajaxHeader5($followerID[$i]);'>
				";
			}

			$i++;
		}
	}else{
		$div .= '
		<h5 style="font-family: cursive;">No notifications!</h5>
		';
	}

	echo $div;
?>