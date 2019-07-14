<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$id1 = $_GET['id1'];
	$newComment = $_GET['newComment'];

	// Adding line break
	$newComment = str_replace("<br>","\n",$newComment);

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$id1 = mysqli_real_escape_string($con,$id1);
	$newComment = mysqli_real_escape_string($con,$newComment);

	// Getting required data
	$sql1 = "SELECT * FROM posts WHERE id = $id1";
	$result1 = $con->query($sql1);
	$uid = "";
	$NoOfComments = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$uid = $row["uid"];
			$NoOfComments = $row['comments'];
		}
	}

	// Commenting
	$sql = "INSERT INTO comments(imageID,commenterID,commentData) VALUES(".$id1.",".$id.",'".$newComment."')";
	$con->query($sql);

	// Adding comment notification
	if($uid != $id){
	  	$sql2 = "INSERT INTO notifications(uid,postID,notificationType,commenterID,commentData) VALUES($uid,$id1,'Comment',$id,'$newComment')";
	  	$con->query($sql2);
	}else{
		$sql2 = "INSERT INTO notifications(uid,postID,notificationType,commenterID,commentData,notificationStatus) VALUES($uid,$id1,'Comment',$id,'$newComment',2)";
	  	$con->query($sql2);
	}

	// Incrementing no of comments
	$currentComments = $NoOfComments + 1;
	$sql3 = "UPDATE posts SET comments=$currentComments WHERE id=$id1";
	$con->query($sql3);

?>