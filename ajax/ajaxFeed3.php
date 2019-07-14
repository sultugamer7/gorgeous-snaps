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

    // Unliking pic
    $sql = "DELETE FROM likes WHERE imageID=$imageId1 AND likerID=$id";
    $con->query($sql);

    // Removing like notification
    if($uid != $id){
      	$sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$imageId1 AND notificationType='Like' AND likerID=$id";
      	$con->query($sql2);
    }else{
        $sql2 = "DELETE FROM notifications WHERE uid=$uid AND postID=$imageId1 AND notificationType='Like' AND likerID=$id";
        $con->query($sql2);
    }

    // Decrementing no of likes
    $currentLikes = $NoOfLikes - 1;
    $sql3 = "UPDATE posts SET likes=$currentLikes WHERE id=$imageId1";
    $con->query($sql3);	

?>