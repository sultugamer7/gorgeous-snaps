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

	if($buttonClicked == "Follow"){

		// Following
		$sql4 = "INSERT INTO followers(uid,followerID) VALUES($id1,$id)";
		$con->query($sql4);

        // Adding Follower notification
    	$sql2 = "INSERT INTO notifications(uid,notificationType,followerID) VALUES($id1,'Follow',$id)";
    	$con->query($sql2);

	}elseif ($buttonClicked == "Unfollow") {

		// Unfollowing
		$sql4 = "DELETE FROM followers WHERE uid=$id1 AND followerID=$id";
		$con->query($sql4);

        // Removing Follower notification
    	$sql2 = "DELETE FROM notifications WHERE uid=$id1 AND notificationType='Follow' AND followerID=$id";
    	$con->query($sql2);

	}

?>