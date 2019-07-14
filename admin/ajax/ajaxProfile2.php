<?php
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	
	// Deleting user's profile pic from folder
	$sql10 = "SELECT * FROM users WHERE id=$id";
	$result1 = $con->query($sql10);
	while($row = $result1->fetch_assoc()){
		$profilePic = '../../'.$row['image'];
		if($profilePic != '../../'){
			unlink($profilePic);
		}
	}

    // Deleting pics from user's folder
	$sql = "SELECT * FROM posts WHERE uid=$id";
	$result1 = $con->query($sql);
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$imageLocation = '../../'.$row['image'];
			$imageID = $row['id'];
			unlink($imageLocation);

            // Deleting all the comments from the user's pics
			$sql2 = "DELETE FROM comments WHERE imageID=$imageID";
			$con->query($sql2);

            // Deleting all the likes from the user's pics
			$sql9 = "DELETE FROM likes WHERE imageID=$imageID";
			$con->query($sql9);
		}
	}

    // Deleting user's entire folder
	rmdir("../../images/posts/".$id);

    // Deleting user from db
	$sql3 = "DELETE FROM users WHERE id=$id";
	$con->query($sql3);

    // Deleting user pics from db
	$sql4 = "DELETE FROM posts WHERE uid=$id";
	$con->query($sql4);

    // Deleting user comments from db
	$sql5 = "DELETE FROM comments WHERE commenterID=$id";
	$con->query($sql5);

    // Deleting user likes from db
	$sql6 = "DELETE FROM likes WHERE likerID=$id";
	$con->query($sql6);

    // Deleting user notifications from db
	$sql7 = "DELETE FROM notifications WHERE uid=$id OR likerID=$id OR commenterID=$id OR followerID=$id";
	$con->query($sql7);

    // Deleting user followers from db
	$sql8 = "DELETE FROM followers WHERE uid=$id OR followerID=$id";
	$con->query($sql8);

?>