<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$id0 = $_GET['id0'];
	$id1 = $_GET['id1'];
	$commentID = $_GET['commentID'];
	$commentData = $_GET['commentData'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$id0 = mysqli_real_escape_string($con,$id0);
	$id1 = mysqli_real_escape_string($con,$id1);
	$commentID = mysqli_real_escape_string($con,$commentID);
	$commentData = mysqli_real_escape_string($con,$commentData);

	// Decoding encoded data
	$commentData = urldecode(utf8_decode($commentData));

	// Getting required data
	$sql1 = "SELECT * FROM posts WHERE id = $id1";
	$result1 = $con->query($sql1);
	$uid = "";
	$NoOfComments = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$uid = $row['uid'];
			$NoOfComments = $row['comments'];
		}
	}


	// Deleting comments
	$sql4 = "DELETE FROM comments WHERE commentID=".$commentID;
	$con->query($sql4);

	// Removing comment notification
	if($uid != $id){
		$sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$id1 AND notificationType='Comment' AND commenterID=$id AND commentData='$commentData'";
		$con->query($sql2);
	}else{
		$sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$id1 AND notificationType='Comment' AND commenterID=$id AND commentData='$commentData'";
		$con->query($sql2);
	}

	// Decrementing no. of comments
	$currentComments = $NoOfComments - 1;
	$sql3 = "UPDATE posts SET comments=$currentComments WHERE id=$id1";
	$con->query($sql3);

?>