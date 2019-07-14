<?php
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$username = $_GET['username'];
	$fromDate = $_GET['fromDate'];
	$toDate = $_GET['toDate'];

	// Escape User Input to help prevent SQL Injection
	$username = mysqli_real_escape_string($con,$username);
	$fromDate = mysqli_real_escape_string($con,$fromDate);
	$toDate = mysqli_real_escape_string($con,$toDate);

	// Converting dates to MySQL format
	$fromDate1 = date("Y-m-d H:i:s", strtotime($fromDate)); 
	$toDate1 = date("Y-m-d H:i:s", strtotime($toDate. ' + 1 day'));

	$sql = '';
	if($username != ''){
		$sql = "SELECT * FROM users WHERE username LIKE '$username%' AND regdate BETWEEN '$fromDate1' AND '$toDate1' ORDER BY username";
	}else{
		$sql = "SELECT * FROM users WHERE regdate BETWEEN '$fromDate1' AND '$toDate1' ORDER BY username";
	}

	$users = '';

	$result = $con->query($sql);
	if($result->num_rows > 0){
		$users .= '
			<div class="panel-body" style="overflow-y: scroll; margin-left: -31px; width: 676.5px; height: 400px; margin-top: -16px;">
			<div class="row" style="margin-top: 16px; margin-left: -1px; width: 660px;">
		';
		while($row = $result->fetch_assoc()){
			$id1 = $row["id"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$email = $row["email"];
			$username = $row["username"];
			$password = $row["password"];
			$bio = $row["bio"];
			$profilepic = "../".$row["image"];
			if($profilepic == "../"){
				$profilepic = '../img/16.jpg';
			}
			$regdate = $row["regdate"];
			$regdate = date("d-m-Y", strtotime($regdate));
			$users .= '
				<div class="col-md-3">
					<center>
						<img src='.$profilepic.' style="height: 50px; width: 50px; object-fit: cover;" class="rounded-circle shadow">
						<br/><a href=profile.php?id='.$id1.'>'.$username.'</a>
						<br/><label style="font-size: 10.5px;">Date Joined : '.$regdate.'</label>
					</center>
				</div>
			';
		}
		$users .= "
			</div>
		</div>
		";
	}else{
		$users .= "
			User not found!
		";
	}

	echo $users;

?>