<?php
	

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);

	$div = '';

	// Displaying posts from users you follow and your own posts according to ID in descending order
	$sql = "SELECT * FROM posts WHERE uid IN (SELECT uid FROM followers WHERE followerID=$id) OR uid = $id ORDER BY id DESC";
  	$result = $con->query($sql);
  	$i = 1;
  	if ($result->num_rows < 1) {
  		$div .= "
  			<div class='jumbotron jumbotronstyle1'>
  				<center><h5>Follow some people to see their Gorgeous Snaps!</h5></center>
  			</div>
  		";
  	}else{
  		while($row = $result->fetch_assoc()) {
  			$div .= "";
  			$uid = $row['uid'];
  			$imageId1 = $row['id'];
  			$image1 = $row['image'];
  			$caption = $row['caption'];
  			$datetime = $row['datetime'];
  			$NoOfLikes = $row['likes'];
  			$NoOfComments = $row['comments'];
  			$query = "SELECT * FROM users WHERE id = $uid";
  			$profresult = $con->query($query);
  			$profilepic = "";
  			while($row0 = $profresult->fetch_assoc()) {
  				$profilepic = $row0['image'];
  				$uname = $row0['username'];
  			}
  			$div .= "
	  			<div class='jumbotron jumbotronstyle2'>
	  				<div class='row vertical-align'>
	  					<div class='col-md-1'>
	  						<input type='hidden' name='imageId2' value='".$imageId1."'>
	  						<input type='hidden' name='NoOfLikes2'value='".$NoOfLikes."'>
	  						<input type='hidden' name='NoOfComments2'value='".$NoOfComments."'>
	  			";
	  						if($profilepic == ""){
			                	$div .= "<img src='img/16.jpg' class='imagefit2' style='padding: 0.5rem 1rem !important;'>";
			              	}else{
			                	$div .= "<img src='$profilepic' class='imagefit2' style='padding: 0.5rem 1rem !important;'>";
			              	}
			              	$div .= "
	  										
	  					</div>
	  					<div class='col-md-10' style='padding-top: 10px; padding-left: 20px;'>
	  						<a href='profile.php?id=".$uid."' style='color: black; padding-left: 25px;'>".$uname."</a>
	  					</div>
	  					<div class='col-md-1'>
	  						<!-- Button to Open the Modal -->
							<button type='button' class='btn btn-dark btn-sm' style='margin-left: -22px;' data-toggle='modal' data-target='#myModal' name='Details' onclick='ajaxFeed5($uid,$imageId1);'>
									. . . 
							</button>
	  					</div>
	  				</div>

	  				<hr style='margin-bottom: -0.92rem;'>
	  				<img src='".$image1."' class='d-block w-100 imagefit3'>
	  				<hr style='margin-top: -0.679rem; margin-bottom: 0.7rem;'>

	  				<div style='padding-left: 10px;'>
	  					<div class='row'>
	  						<div class='col-md-11'>
	  							";

	  							// Counting number of likes and getting likeID, likerID, & datetime
	  							$sql6 = "SELECT * FROM likes WHERE imageID=$imageId1 ORDER BY likeID ASC";
	  							$result6 = $con->query($sql6);
	  							$getLikeID = array();
	  							$getLiker = array();
	  							$getLikeDateTime = array();
	  							$li = 0;
	  							if($result6->num_rows > 0){
	  								while($row6 = $result6->fetch_assoc()){
	  									$getLikeID[$li] = $row6['likeID'];
	  									$getLiker[$li] = $row6['likerID'];
	  									$getLikeDateTime[$li] = $row6['datetime'];
	  									$li = $li + 1;
	  								}
	  							}
	  							if($li != 1){
	  								$div .= "<b>".$li."</b> likes";
	  							}else{
	  								$div .= "<b>".$li."</b> like";
	  							}
	  										
	  										
	  							// Counting no. of comments & getting commentID, comments, commenterID, & datetime
				  				$sql1 = "SELECT * FROM comments WHERE imageID = ".$imageId1." ORDER BY commentID ASC";
				  				$result1 = $con->query($sql1);
				  				$getCommeD = array();
				  				$getComment = array();
				  				$getCommenter = array();
				  				$getDateTime = array();
				  				$p = 0;
				  				if ($result1->num_rows > 0) {
					  				while($row1 = $result1->fetch_assoc()) {
					  					$getCommentID[$p] = $row1['commentID'];
					  					$getComment[$p] = $row1['commentData'];
					  					$getCommenter[$p] = $row1['commenterID'];
					  					$getDateTime[$p] = $row1['datetime'];
					  					$p = $p + 1;
					  				}
				  				}
				  				if($p != 1){
				  					$div .= "<b style='padding-left: 10px;'>".$p."</b> comments";
				  				}else{
				  					$div .= "<b style='padding-left: 10px;'>".$p."</b> comment";
				  				}
				  				$div .= "
	  						</div>

	  						<div class='col-md-1'>
	  							<span>
	  								";

	  								// Checking if the current pic is liked by logged in user or not
	  								$sql5 = "SELECT * FROM likes WHERE imageID=$imageId1 AND likerID=$id";
	  								if ($con->query($sql5)->num_rows > 0) {
	  									$div .= "
				  							<input type='button' value='❤' title='Liked' style='margin-left: -35px;' class='btn btn-outline-dark' id='Unlike' onclick='ajaxFeed3($imageId1,$uid,$NoOfLikes)'>
				  						";
	  								}else{
	  									$div .= "
				  							<input type='button' value='👍' title='Like' style='margin-left: -35px;' class='btn btn-outline-dark' id='Like' onclick='ajaxFeed2($imageId1,$uid,$NoOfLikes)'>
				  						";
	  								}
	  								$div .= "
				  				</span>
	  						</div>

	  					</div>
		  			</div>

		  			<hr style='margin-top: 0.7rem; margin-bottom: 0.3rem;'>

		  			<div class='row'>
		  				<div class='col-md-10'>
		  					<div style='padding-left: 10px;'>
				  				<span>
				  						";
					  				if($caption == ""){
					  					$div .= " <h6 style='color: #708090; font-weight: normal; font-style: italic'>No caption...</h6>";
					  				}else{
					  					$div .= "<h6 style='font-weight: normal;'>".nl2br($caption)."</h6>";
					  				}
					  				$div .= "
					  			</span>
				  				<span style='font-size: 0.7rem; color: #708090;'>
				  					".$datetime."
				  				</span>
				  			</div>
		  				</div>

		  				<div class='col-md-2'>

		  					
		  				</div>
		  			</div>
		  							";



		  			// Displaying comments on feed
		  			if(count($getComment) > 0){
		  				$div .= "<hr style='margin-top: 0.37rem; margin-bottom: 0rem;'>
		  				<div style='padding-left: 10px; font-weight: 500'>Recent comments :</div>";
		  				$q = 0;
		  				if(count($getComment) > 3){
		  					$q = count($getComment) - 3;
		  				}
			  			for($q; $q < count($getComment); $q++){
			  				$id1 = $getCommenter[$q];
			  				$sql2 = "SELECT username FROM users WHERE id=".$id1;
			  				$result2 = $con->query($sql2);
			  				while($row2 = $result2->fetch_assoc()) {
			  					$commenterusername = $row2['username'];
			  				}
			  								
			  				$div .= "
		  						<div style='padding-left: 10px;'>
		  							<div class='row'>
		  								<div class='col-md-10'>
			  								<span style='margin-top: 0px; margin-bottom: 0px; color: #708090;'>
					  							<a href='profile.php?id=".$id1."' style='color: black;'>".$commenterusername."
					  							</a>
					  							: ".nl2br($getComment[$q])."
					  						</span>
		  								</div>
		  								<div class='col-md-2' style='padding-top: 2px; padding-left: 33px;'>
		  									<span style='margin-top: 10px; font-size: 10px !important; color: #708090;'>".$getDateTime[$q]."</span>
		  								</div>
		  							</div>	
			  					</div>
			  					";
			  			}
		  			}
		  			$div .= "
		  				<hr style='margin-top: 0.37rem; margin-bottom: 0rem;'>
		  				<div style='padding-left: 10px;'>
		  					<div class='row'>
		  						<div class='col-md-11'>
		  							<input type='text' class='textarea' id='newComment".$imageId1."' placeholder='Add a comment... (Max 100 characters)' maxlength='100'>
		  						</div>
		  						<div class='col-md-1'>
		  							<input type='button' name='Add' title='Comment' value='💬' class='btn btn-outline-dark' style='margin-left: -35px; margin-top: 3.08px;' onclick='ajaxFeed4($imageId1,$uid,$NoOfComments,$imageId1)'>
		  						</div>
		  					</div>
	  					</div>
	  				</div>
	  			";
	  			$i += 1;
  		}
  	}

  	echo $div;

?>