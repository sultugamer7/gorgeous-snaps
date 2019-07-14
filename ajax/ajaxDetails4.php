<?php
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id1 = $_GET['id1'];
	$newCaption = $_GET['newCaption'];

	// Adding line break
	$newCaption = str_replace("<br>","\n",$newCaption);
	
	// Updating caption
	$sql3 = "UPDATE posts SET caption='".$newCaption."' WHERE id='".$id1."'";
    $con->query($sql3);

    echo $newCaption;
?>

