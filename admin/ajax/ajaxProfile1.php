<?php

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$username = $_GET['username'];
	$username1 = $_GET['username1'];
	$id = $_GET['id'];
	$id1 = $_GET['id1'];

	// Escape User Input to help prevent SQL Injection
	$username = mysqli_real_escape_string($con,$username);
	$username1 = mysqli_real_escape_string($con,$username1);
	$id = mysqli_real_escape_string($con,$id);
	$id1 = mysqli_real_escape_string($con,$id1);

	// Getting required data
	$sql1 = "SELECT * FROM users WHERE id = $id1";
	$result1 = $con->query($sql1);
	$firstname1 = "";
	$lastname1 = "";
	$bio1 = "";
	$image1 = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$firstname1 = $row["firstname"];
			$lastname1 = $row['lastname'];
			$bio1 = $row['bio'];
			$image1 = $row['image'];
		}
	}

	$div = '';

	// Delete user 
	$div .= '<a type="button" class="btn btn-danger btn-sm shadow" onclick="return deleteConfirmation();">Delete User</a>';

    $div .= '<div style="padding-top: 13px;">';

    // Counting no. of posts of the user
    $sql1 = "SELECT * FROM posts WHERE uid = $id1";
	$result1 = $con->query($sql1);
	$totalPosts = 0;
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$totalPosts += 1;
		}
	}

	// Couting no. of followers of the user
	$sql1 = "SELECT * FROM followers WHERE uid = $id1";
	$result1 = $con->query($sql1);
    $totalFollowers = 0;
    if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$totalFollowers += 1;
		}
	}

	// Couting no. of ppl the user follows
	$sql1 = "SELECT * FROM followers WHERE followerID = $id1";
	$result1 = $con->query($sql1);
    $totalFollowing = 0;
    if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$totalFollowing += 1;
		}
	}

	$div .= '
		<span>
			<a type="button" class="btn btn-link btn-sm" href="#profile2" style="background: bisque;">
			';
				if($totalPosts == 1){
	              	$div .= "<b>$totalPosts</b> post";
	            }else{
	              	$div .= "<b>$totalPosts</b> posts";
	            }
	$div .= '
			</a>
        </span>

        <span style="padding-left: 20px;">
			<a type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#followerModal" style="background: bisque;">
			';
				if($totalFollowers == 1){
	              	$div .= "<b>$totalFollowers</b> follower";
	            }else{
	              	$div .= "<b>$totalFollowers</b> followers";
	            }
	$div .= '
			</a>
        </span>

        <span style="padding-left: 20px;">
            <a type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#followingModal" style="background: bisque;">
              	<b>'.$totalFollowing.'</b> following
            </a>

        </span>

        </div>

        <div style="padding-top: 7px;">
            <b>'.$firstname1.' '.$lastname1.'</b>
        </div>

        <div style="padding-top: 3px; margin-bottom: 5px;">'.nl2br($bio1).'</div>

    </div>
    ';

    $div .= '
    	<!-- Followers Modal -->
		<div id="followerModal" class="modal fade" role="document">
		    <div class="modal-dialog modal-sm">
		        <!-- Modal content-->
		    	<div class="modal-content">
		      		<div class="modal-header">
		      			<b style="font-weight: 500; color: red;">
		    ';
		              		if($totalFollowers == 1){
		              			$div .= $username1."'s follower :";
		              		}else{
		              			$div .= $username1."'s followers :";
		              		}
    $div .= '
	            		</b>
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		</div>
		      		<div class="modal-body">
		    ';
		        	$sql5 = "SELECT * FROM followers WHERE uid = $id1";
		        	$result5 = $con->query($sql5);
		        	if($result5->num_rows > 0){
		        		while($row = $result5->fetch_assoc()){
		        			$follID = $row['followerID'];
		        			$sql6 = "SELECT * FROM users WHERE id = $follID";
		        			$result6 = $con->query($sql6);
		        			if($result6->num_rows > 0){
		        				while($row1 = $result6->fetch_assoc()){
		        					$follProfilePic = $row1['image'];
		        					$follUsername = $row1['username'];
		        				}
		        				$div .= "
		        					<div class='row vertical-align'>
		        						<div class='col-md-3' style='height: 54px;'>
		        				";
		        				if($follProfilePic == ""){
					                $div .= "<img src='img/16.jpg' class='imagefit2 rounded-circle'>";
					            }else{
					                $div .= "<img src='../$follProfilePic' class='imagefit2 rounded-circle'>";
					            }
					            $div .= "
					            		</div>
					            		<div class='col-md-3' style='margin-left: -8px; margin-top: -25px;'>
					            			<a href='profile.php?id=$follID' style='color: black;'>$follUsername</a>
					            		</div>
					            	</div>
					            ";
		        			}
		        		}
		        	}else{
		        		$div .= "<b>".$username1."</b> has 0 followers!";
		        	}
    $div .= '
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		      		</div>
		    	</div>
		  	</div>
		</div>
	';

	$div .= '
		<!-- Following Modal -->
		<div id="followingModal" class="modal fade" role="document">
		    <div class="modal-dialog modal-sm">
		    	<!-- Modal content-->
		        <div class="modal-content">
		        	<div class="modal-header">
		      	    	<b style="font-weight: 500; color: red;">
		    ';
		      		    	$div .= $username1."'s following :";
    $div .= '
	            		</b>
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		</div>
		      		<div class="modal-body">
		    ';
		        		$sql5 = "SELECT * FROM followers WHERE followerID = $id1";
		        		$result5 = $con->query($sql5);
		        		if($result5->num_rows > 0){
		        			while($row = $result5->fetch_assoc()){
			        			$follID = $row['uid'];
			        			$sql6 = "SELECT * FROM users WHERE id = $follID";
			        			$result6 = $con->query($sql6);
			        			if($result6->num_rows > 0){
			        				while($row1 = $result6->fetch_assoc()){
			        					$follProfilePic = $row1['image'];
			        					$follUsername = $row1['username'];
			        				}
			        				$div .= "
			        					<div class='row vertical-align'>
			        						<div class='col-md-3' style='height: 54px;'>
			        				";
			        				if($follProfilePic == ""){
						                $div .= "<img src='img/16.jpg' class='imagefit2 rounded-circle'>";
						            }else{
						                $div .= "<img src='../$follProfilePic' class='imagefit2 rounded-circle'>";
						            }
						            $div .= "
						            		</div>
						            		<div class='col-md-3' style='margin-left: -8px; margin-top: -25px;'>
						            			<a href='profile.php?id=$follID' style='color: black;'>$follUsername</a>
						            		</div>
						            	</div>
						            ";
			        			}
			        		}
		        		}else{
		        			$div .= "<b>".$username1."</b> follow 0 users!";
		        		}
    $div .= '
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		     	 	</div>
		    	</div>
		    </div>
		</div>
    ';

    echo $div;

?>