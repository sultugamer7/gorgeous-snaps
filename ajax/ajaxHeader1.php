<?php

	include "../database.php";

	$output = '';
	$query = '';
	if(isset($_POST["query"])){
		$search = mysqli_real_escape_string($con, $_POST["query"]);
		$query = "SELECT * FROM users WHERE username LIKE '".$search."%'";
	}
		// else{
		//  	$query = "SELECT NULL FROM users";
		// }
	if($query != ''){
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$username = $row["username"];
				$id = $row["id"];
				$image = $row["image"];
				if($image == ""){
					$image = 'img/16.jpg';
				}
				$output .= '
				<div class="dropdown-item" onclick="location.href=\'profile.php?id='.$id.'\';" style="cursor: pointer;">
				<img src='.$image.' style="height: 45px; width: 54px; object-fit:cover;">
				<label style="padding-left: 8px;">'.$username.'</label>
				</div>
				';
			}
			echo $output;
		}
		else
		{
			echo '<label style="padding-left: 20px;">User not found!</label>';
		}
	}
?>