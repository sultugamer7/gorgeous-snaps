<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String;
	$id = $_GET['id'];
	$imageId1 = $_GET['imageId1'];
	$uid = $_GET['uid'];
	$NoOfComments = $_GET['NoOfComments'];
	$newComment = $_GET['newComment'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$imageId1 = mysqli_real_escape_string($con,$imageId1);
	$uid = mysqli_real_escape_string($con,$uid);
	$NoOfComments = mysqli_real_escape_string($con,$NoOfComments);
	$newComment = mysqli_real_escape_string($con,$newComment);

  	// Commenting
	$sql = "INSERT INTO comments(imageID,commenterID,commentData) VALUES(".$imageId1.",".$id.",'".$newComment."')";
	$con->query($sql);

	// Adding comment notification
	if($uid != $id){
	  	$sql2 = "INSERT INTO notifications(uid,postID,notificationType,commenterID,commentData) VALUES($uid,$imageId1,'Comment',$id,'$newComment')";
	  	$con->query($sql2);
	}else{
        $sql2 = "INSERT INTO notifications(uid,postID,notificationType,commenterID,commentData,notificationStatus) VALUES($uid,$imageId1,'Comment',$id,'$newComment',2)";
        $con->query($sql2);
    }

	// Incrementing no of comments
	$currentComments = $NoOfComments + 1;
	$sql3 = "UPDATE posts SET comments=$currentComments WHERE id=$imageId1";
	$con->query($sql3);

?>