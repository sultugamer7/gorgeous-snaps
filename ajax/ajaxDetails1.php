<?php
	
	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];
	$id0 = $_GET['id0'];
	$id1 = $_GET['id1'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);
	$id0 = mysqli_real_escape_string($con,$id0);
	$id1 = mysqli_real_escape_string($con,$id1);

	// Getting required data
	$sql1 = "SELECT * FROM posts WHERE id = $id1";
	$result1 = $con->query($sql1);
	$uid = "";
	$image1 = "";
	$caption = "";
	$datetime = "";
	$NoOfLikes = "";
	$NoOfComments = "";
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$uid = $row["uid"];
			$image1 = $row['image'];
			$caption = $row['caption'];
			$datetime = $row['datetime'];
			$NoOfLikes = $row['likes'];
			$NoOfComments = $row['comments'];
		}
	}

	$profilepic90 = "";
	$username90 = "";
	$sql2 = "SELECT * FROM users WHERE id=$id0";
	$result2 = $con->query($sql2);
	while($row = $result2->fetch_assoc()){
		$profilepic90 = $row['image'];
		$username90 = $row['username'];
	}

	if($profilepic90 == ''){
		$profilepic90 = "img/16.jpg";
	}

	$div1 = '';

	$div1 .= '
		<div class="row" style="margin-top: -64px; margin-left: -32px; width: 1168px;">

			<!-- Displaying image, date posted, caption, update caption and delete image section -->
			<div class="col-md-8" style="padding-left: 0; padding-right: 0; background: currentColor;">

				<!-- Displaying datetime -->
				<label style="position: absolute; color: black; background: rgba(255,255,255,0.6); font-size: 12px; padding-left: 5px; padding-right: 5px;"> Date & Time Posted :<br/>'.$datetime.'</label>

				<!-- Displaying image and date posted -->
				<center>
					<img src="'.$image1.'" style="width: 778px; object-fit: contain; height: 470px;">
				</center>

				';
				if($id == $id0){
					$div1 .= '
					<!-- Displaying caption, update caption and delete image section for logged in user pic-->
					<div class="row" style="margin-left: 0px; width: 777px; height: 62.3px; background: white;">

						<!-- Displaying caption and update caption section -->
						<div class="col-md-10" style="padding-left: 5px; ">
							<div class="row">

								<!-- Displaying caption -->
								<div class="col-md-9">
								';
									if($caption == ''){
										$div1 .= '
											<textarea row="1" column="50" maxlengh="150" class="form-control" style="width: 542px; padding-left: 5px; font-weight: 500; margin-left: -5px; height: 62.8px; border-radius: 0;" placeholder="No caption..." name="newCaption" id="newCaption" maxlength="150"></textarea>
										';
									}else{
										$div1 .= '
											<textarea row="1" column="50" maxlengh="150" class="form-control" style="padding-left: 5px; width: 542px; margin-left: -5px; height: 62.8px; border-radius: 0;" placeholder="'.$caption.'" name="newCaption" id="newCaption" maxlength="150"></textarea>
										';
									}

								$div1 .= '
								</div>

								<!-- Displaying Update caption button -->
								<div class="col-md-3">
									<input type="button" class="btn btn-primary" style="margin-top: 12px; margin-left: 51px; width: 106px;" value="Update" id="Update" onclick="ajaxDetails4();">
								</div>

							</div>
						</div>

						<!-- Displaying delete image button -->
						<div class="col-md-2">
							<input type="button" class="btn btn btn-danger" style="margin-top: 12px; margin-left: 1px;" value="Delete Post" id="Delete" onclick="return confirmation();">
						</div>
					</div>
					';
				}else{
					if($caption == ''){
						$div1 .= '
							<textarea disabled row="1" column="50" maxlengh="150" class="form-control" style="padding-left: 5px; width: 777px; background: white; margin-left: 0px; height: 63px; border-radius: 0;" placeholder="No caption..." name="newCaption" id="newCaption" maxlength="150"></textarea>
						';
					}else{
						$div1 .= '
							<textarea disabled row="1" column="50" maxlengh="150" class="form-control" style="padding-left: 5px; width: 777px; background: white; margin-left: 0px; height: 63px; border-radius: 0;" placeholder="'.$caption.'" name="newCaption" id="newCaption" maxlength="150"></textarea>
						';
					}
				}
			$div1 .= '
				</div>

			<!-- Displaying profile pic, username, total likes, total comments, like, and add comment -->
			<div class="col-md-4" style="padding-left: 0; padding-right: 0;">

				<!-- Displaying profile pic & username -->
				<div class="row" style="margin-top: 11px;">
					<img src="'.$profilepic90.'" class="imagefit rounded-circle">
					<a href="profile.php?id='.$id0.'" style="margin-top: 8px; font-size: 20px; margin-left: 10px; font-weight: 500; color: black;">'.$username90.'</a>
				</div>
				<hr style="margin-top: 24px;">
				';

				// Getting post's likes details
				$sql6 = "SELECT * FROM likes WHERE imageID=$id1 ORDER BY likeID DESC";
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

				// Grammer correction for no. of likes
				if($NoOfLikes != 1){
					$div1 .= "
						<p style='font-size: 14px; font-weight: 500; margin-left: 10px; margin-bottom: 3px; margin-top: -8px;' title='Likes'>$NoOfLikes ❤</p>
					";
				}else{
					$div1 .= "
						<p style='font-size: 14px; font-weight: 500; margin-left: 10px; margin-bottom: 3px; margin-top: -8px;' title='Like'>$NoOfLikes ❤</p>
					";
				}

				$div1 .= "
				<!-- Displaying likes -->
				<div class='panel-body' style='margin-left: 0px; overflow-y: scroll; height: 180px; width: 390px; border-style: double;'>
					<div class='mid-width wrapItems' style='height: 176px; margin-left: 10px; width: 348px;'>
						<div id='Test2' width='100%'>
				";
							if(count($getLikeID) > 0){
								$x = 0;
								for($x; $x < count($getLikeID); $x++){
									$id2 = $getLiker[$x];
									$sql7 = "SELECT * FROM users WHERE id=$id2";
									$result7 = $con->query($sql7);
									while($row7 = $result7->fetch_assoc()){
										$likerusername = $row7['username'];
										$likerprofilepic = $row7['image'];
									}
									if($likerprofilepic == ""){
										$div1 .= "
											<div class='vertical-align'>
											<img src='img/16.jpg' class='imagefit2 rounded-circle' style='padding: 0.5rem 1rem !important;'>
										";
									}else{
										$div1 .= "
											<div class='vertical-align'>
											<img src='$likerprofilepic' class='imagefit2 rounded-circle' style='padding: 0.5rem 1rem !important;'>
										";
									}
									$div1 .= "
										<a href='profile.php?id=".$id2."' style='color: black; margin-left: -6px; padding-top: 12px; font-size: 16px;'>".$likerusername."
										</a>
										</div>
										<div style='margin-top: -6px;'>
											<b style='margin-left: 251px; font-size: 10px; color: lightcoral'>".$getLikeDateTime[$x]."
											</b>
										</div>
									";
								}
							}else{
								$div1 .= "
									<span style='margin-top: 0px; margin-bottom: 0px; color: red; font-size: 14.7px; margin-left: 0px;'>
										No likes...
									</span>
								";
							}
    $div1 .= "
						</div>
					</div>
				</div>
		";
				// Getting post's comments details
				$sql1 = "SELECT * FROM comments WHERE imageID = $id1 ORDER BY commentID ASC";
				$result1 = $con->query($sql1);
				$getCommentID = array();
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
				if($NoOfComments != 1){
					$div1 .= "
						<p style='font-size: 14px; font-weight: 500; margin-left: 10px; margin-bottom: 3px; margin-top: 6px' title='Comments'>$NoOfComments 💬</p>
					";
				}else{
					$div1 .= "
						<p style='font-size: 14px; font-weight: 500; margin-left: 10px; margin-bottom: 3px; margin-top: 6px' title='Comment'>$NoOfComments 💬</p>
					";
				}
    $div1 .= "
				<!-- Displaying Comments -->
				<div class='panel-body' style='margin-left: 0px; overflow-y: scroll; height: 180px; width: 390px; border-style: double; overflow-x: hidden;'>
					<div class='mid-width wrapItems' style='height: 176px; margin-left: 10px; width: 348px;'>
						<div id='Test2' width='100%'>
							<form method='post'>
			";
					  			// Displaying comments
								if(count($getCommentID) > 0){
									$x = 0;
									for($x; $x < count($getCommentID); $x++){
										$id2 = $getCommenter[$x];
										$sql2 = "SELECT username FROM users WHERE id=".$id2;
										$result2 = $con->query($sql2);
										while($row2 = $result2->fetch_assoc()) {
											$commenterusername = $row2['username'];

										}
										$div1 .= "
											<span style='margin-top: 0px; margin-bottom: 0px; color: #708090; font-size: 14.7px;'>
												<a href='profile.php?id=".$id2."' style='color: black;' font-size: 14.7px;>".$commenterusername."
												</a>
												: ".nl2br($getComment[$x])."
											</span>
											<div class='row' style='height: 26px;'>
												<div class='col-md-6'>
										";

										// Encoding comment
										$getCommentt = urlencode(utf8_encode($getComment[$x]));
										
										if($uid == $id){
											$div1 .= "
												<input type='button' id='Delete".$x."' title='Delete' value='❌' class='btn btn-sm btn-outline-danger' style='font-size: 9px; margin-left: 3px;' onclick='ajaxDetails2($getCommentID[$x],\"$getCommentt\");'>
											";
										}else{
											if($id == $id2){
												$div1 .= "
													<input type='button' id='Delete".$x."' title='Delete' value='❌' class='btn btn-sm btn-outline-danger' style='font-size: 9px; margin-left: 3px;' onclick='ajaxDetails2($getCommentID[$x],\"$getCommentt\");'>
												";
											}
										}
										$div1 .= "
												</div>
												<div class='col-md-6' style='margin: auto'>
													<b style='margin-left: 62px; font-size: 10px; color: lightcoral'>".$getDateTime[$x]."
															</b>
												</div>
											</div>
										";
									}
								}else{
									$div1 .= "
										<span style='margin-top: 0px; margin-bottom: 0px; color: red; font-size: 14.7px;'>
											No comments...
										</span>
									";
								}
    $div1 .= '
							</form>
						</div>
					</div>
				</div>

				<!-- Displaying Like, Comment Section -->
				<div class="row" style="height: 37px; background: rgba(220,20,60,0.7); margin-left: 0; width: 389px;">
                    <div class="col-md-3">
			';
						// Checking if the current pic is liked by logged in user or not
					  	$sql5 = "SELECT * FROM likes WHERE imageID=$id1 AND likerID=$id";
					  	if ($con->query($sql5)->num_rows > 0) {
					  		$div1 .= '
								  <input type="button" id="LikeUnlike" title="Liked" class="btn btn-sm btn-outline-light" value="❤️" style="background: rgba(255,255,255,0.4); margin-top: 3.2px; margin-left: -12px; width: 55px;" onclick="ajaxDetails5();">
							';
					  	}else{
					  		$div1 .= '
								<input type="button" id="LikeUnlike" title="Like" class="btn btn-sm btn-outline-light" value="👍" style="background: rgba(255,255,255,0.4); margin-top: 3.2px; margin-left: -12px; width: 55px;" onclick="ajaxDetails5();">
							';
					  	}

			$div1 .= '
					</div>

                    <div class="col-md-6">
                        <input type="text" id="newComment" placeholder="Add a comment... (Max 100 characters)" style="margin-left: -50px; margin-top: 3.2px; width: 264px; height: 31px; font-size: 11px; padding-left: 4px; background: rgba(255,255,255,0.33); color: aliceblue;" maxlength="100" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <input type="button" name="Add" id="Comment" class="btn btn-sm btn-outline-light" title="Comment" value="💬" style="background: rgba(255,255,255,0.4); margin-top: 3.2px; margin-left: 24px; width: 55px;" onclick="ajaxDetails6();">
                    </div>
                </div>

			</div>

		</div>

	';

	echo $div1;

?>