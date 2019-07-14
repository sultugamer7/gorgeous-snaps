<?php
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id1 = $_GET['id1'];

	// Escape User Input to help prevent SQL Injection
	$id1 = mysqli_real_escape_string($con,$id1);

	$sql1 = "SELECT * FROM posts WHERE id = $id1";
	$result1 = $con->query($sql1);
	$image1 = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$image1 = $row['image'];
		}
	}
	
	// Deleting pic from folder
	unlink('../'.$image1);

    // Deleting pic location, likes, comments and notifications from db
	$sql4 = "DELETE FROM posts WHERE id=".$id1;
	$con->query($sql4);

	$sql5 = "DELETE FROM comments WHERE imageID=".$id1;
	$con->query($sql5);

	$sql6 = "DELETE FROM likes WHERE imageID=".$id1;
	$con->query($sql6);

	$sql7 = "DELETE FROM notifications WHERE postID=".$id1;
	$con->query($sql7);

?>