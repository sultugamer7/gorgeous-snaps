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
		$sql = "SELECT * FROM posts WHERE uid IN (SELECT id FROM users WHERE username LIKE '$username%') AND datetime BETWEEN '$fromDate1' AND '$toDate1' ORDER BY datetime DESC";
	}else{
		$sql = "SELECT * FROM posts WHERE datetime BETWEEN '$fromDate1' AND '$toDate1' ORDER BY datetime DESC";
	}
	
	$posts = '';

	$result = $con->query($sql);
	if($result->num_rows > 0){
		$posts .= '
			<div class="panel-body" style="overflow-y: scroll; margin-left: -31px; width: 676.5px; height: 400px; margin-top: -16px;">
			<div class="row" style="margin-top: 16px; margin-left: -1px; width: 660px;">
		';
		while($row = $result->fetch_assoc()){
			$id1 = $row["id"];
			$uid = $row["uid"];
			$post = "../".$row["image"];
			$caption = $row["caption"];
			$likes = $row["likes"];
			$comments = $row["comments"];
			$dateposted = $row["datetime"];
			$dateposted = date("d-m-Y", strtotime($dateposted));

			$sql2 = "SELECT username FROM users WHERE id=$uid";
			$result2 = $con->query($sql2);
			$username = '';
			while($row = $result2->fetch_assoc()){
				$username = $row['username'];
			}
			$posts .= '
				<div class="col-md-4">
					<center>
						<a href="details.php?id='.$id1.'&id0='.$uid.'"><img src='.$post.' style="height: 144px; width: 181px; object-fit: contain; border-style: double;" class="shadow"></a>
						<br/><a href=profile.php?id='.$uid.'>'.$username.'</a>
						<br/><label style="font-size: 10.5px; margin-bottom: 12px">Date Posted : '.$dateposted.'</label>
					</center>
				</div>
			';
		}
		$posts .= "
			</div>
		</div>
		";
	}else{
		$posts .= "
			Post not found!
		";
	}

	echo $posts;

?>