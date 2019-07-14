<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$uid = $_GET['uid'];
	$imageId1 = $_GET['imageId1'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$uid = mysqli_real_escape_string($con,$uid);
	$imageId1 = mysqli_real_escape_string($con,$imageId1);

	$div = '
		<div class="modal-body">
			<center>
		';		
			if($id != $uid){
				$div .= '
					<a href="reportPost.php?id='.$imageId1.'&id0='.$uid.'">Report Post</a>
					<hr style="margin-top: 8px; margin-bottom: 5px;">

					<a href="reportUser.php?id1='.$uid.'&id='.$id.'">Report User</a>
					<hr style="margin-top: 8px; margin-bottom: 5px;">
				';
			}
	$div .= '
				<a href="details.php?id='.$imageId1.'&id0='.$uid.'">Details</a>
				<hr style="margin-top: 8px; margin-bottom: 5px;">

				<a href="profile.php?id='.$uid.'">View Profile</a>
				<hr style="margin-top: 8px; margin-bottom: 5px;">

				<a href=""data-dismiss="modal">Close</a>
			</center>
		</div>
	';

	


	echo $div;

?>