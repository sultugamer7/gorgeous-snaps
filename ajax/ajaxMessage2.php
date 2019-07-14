<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$receiverID = $_GET['receiverID'];
	$messageData = $_GET['messageData'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$receiverID = mysqli_real_escape_string($con,$receiverID);
	$messageData = mysqli_real_escape_string($con,$messageData);

	// Inserting message
	$sql = "INSERT INTO messages(uid,receiverID,messageData) VALUES($id,$receiverID,'$messageData')";
	$con->query($sql);

?>