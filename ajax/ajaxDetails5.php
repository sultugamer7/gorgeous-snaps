<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$id1 = $_GET['id1'];
	$buttonClicked = $_GET['buttonClicked'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$id1 = mysqli_real_escape_string($con,$id1);
	$buttonClicked = mysqli_real_escape_string($con,$buttonClicked);

	// Getting required data
	$sql1 = "SELECT * FROM posts WHERE id = $id1";
	$result1 = $con->query($sql1);
	$uid = "";
	$NoOfLikes = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$uid = $row["uid"];
			$NoOfLikes = $row['likes'];
		}
	}

	if($buttonClicked == "👍"){

		// Liking pic
  		$sql = "INSERT INTO likes(imageID,likerID) VALUES($id1,$id)";
  		$con->query($sql);

  		// Adding like notification
  		if($uid != $id){
  			$sql2 = "INSERT INTO notifications(uid,postID,notificationType,likerID) VALUES($uid,$id1,'Like',$id)";
  			$con->query($sql2);
  		}else{
  			$sql2 = "INSERT INTO notifications(uid,postID,notificationType,likerID,notificationStatus) VALUES($uid,$id1,'Like',$id,2)";
  			$con->query($sql2);
  		}

  		// Incrementing no. of likes
  		$currentLikes = $NoOfLikes + 1;
  		$sql3 = "UPDATE posts SET likes=$currentLikes WHERE id=$id1";
  		$con->query($sql3);

	}elseif ($buttonClicked == "❤️") {

		// Unliking pic
  		$sql = "DELETE FROM likes WHERE imageID=$id1 AND likerID=$id";
  		$con->query($sql);

  		// Removing like notification
  		if($uid != $id){
  			$sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$id1 AND notificationType='Like' AND likerID=$id";
  			$con->query($sql2);
  		}else{
  			$sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$id1 AND notificationType='Like' AND likerID=$id";
  			$con->query($sql2);
  		}

  		// Decrementing no of likes
  		$currentLikes = $NoOfLikes - 1;
  		$sql3 = "UPDATE posts SET likes=$currentLikes WHERE id=$id1";
  		$con->query($sql3);

	}

?>