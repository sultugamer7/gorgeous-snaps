<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String;
	$id = $_GET['id'];
	$imageId1 = $_GET['imageId1'];
	$uid = $_GET['uid'];
	$NoOfLikes = $_GET['NoOfLikes'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$imageId1 = mysqli_real_escape_string($con,$imageId1);
	$uid = mysqli_real_escape_string($con,$uid);
	$NoOfLikes = mysqli_real_escape_string($con,$NoOfLikes);

  	// Liking pic
  	$sql = "INSERT INTO likes(imageID,likerID) VALUES($imageId1,$id)";
  	$con->query($sql);

  	// Adding like notification
  	if($uid != $id){
  		$sql2 = "INSERT INTO notifications(uid,postID,notificationType,likerID) VALUES($uid,$imageId1,'Like',$id)";
  		$con->query($sql2);
  	}else{
  		$sql2 = "INSERT INTO notifications(uid,postID,notificationType,likerID,notificationStatus) VALUES($uid,$imageId1,'Like',$id,2)";
  		$con->query($sql2);
  	}

  	// Incrementing no. of likes
  	$currentLikes = $NoOfLikes + 1;
  	$sql3 = "UPDATE posts SET likes=$currentLikes WHERE id=$imageId1";
  	$con->query($sql3);

?>