<?php
	

	include "../database.php";
	include "../bootstrap.php";

	// Retrieve data from Query String
	$id = $_GET['id'];

	// Escape User Input to help prevent SQL Injection
	$id = mysqli_real_escape_string($con,$id);

	$div1 = '';
                $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 9";
                $result = $con->query($sql);
                $n=1;
                while($row = $result->fetch_assoc()) {

                  $uid = $row['uid'];
                  $imageId1 = $row['id'];
                  $image1 = $row['image'];
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
                  if($profilepic == ""){
                    $profilepic = "img/16.jpg";
                  }

                  if($n > 3){
                    $div1 .= '
                      <div class="col-md-4" style="margin-top: 27px; height: 300px; width: 339px;">
                    ';
                  }else{
                    $div1 .= '
                      <div class="col-md-4" style="height: 300px; width: 339px;">
                    ';
                  }

                  $div1 .= '
                    <div class="hovereffect">
                      <img class="img-responsive" src="'.$image1.'" style="height: 300px; width: 339px; object-fit: cover; border-style: solid; border-radius: 2px; border-width: 2px; border-color: white">
                      <div class="overlay">
                        <h2 style="height: 40px;">
                        	<div class="row">
                        		<div class="col-md-2" style="margin-left: -4px;">
                        			<img src="'.$profilepic.'" style="height: 29px; width: 30px; object-fit: cover; margin-top: -4.5px;" class="rounded-circle">
                        		</div>
                        		<div class="col-md-7" style="margin-top: 0px; margin-left: -82px; font-size: 14px;">
                        			<a href="profile.php?id='.$uid.'">'.$uname.'</a>
                        		</div>
                        		<div class="col-md-3" style="margin-top: -8px; margin-left: 52px; font-size: 14px;">
                              <label style="margin-left: 61px; width: 41px;">
                          			';

      				                  if($NoOfLikes != 0){
      				                    $div1 .= $NoOfLikes.' ❤️<br/>';
      				                  }else{
      				                    $div1 .= $NoOfLikes.' ❤️<br/>';
      				                  }

                                if($NoOfComments != 1){
                                  $div1 .= $NoOfComments.' 💬';
                                }else{
                                  $div1 .= $NoOfComments.' 💬';
                                }
  				                  $div1 .= '
                            </label>
                              <label style="width: 120px;">'.$datetime.'</label>

                        		</div>
                        	</div>
                        </h2>
                        <a class="info" href="details.php?id='.$imageId1.'&id0='.$uid.'">Details</a>

                        <!-- Likes and comments -->
                        <br/><br/><br/><br/>
                        <div class="row" style="margin-top: 21px; height: 40px; background: rgba(0,0,0,0.6);">
                        	<div class="col-md-3">
                        	';

                        	// checking if the pic is liked by logged in user
                        	$sql2 = "SELECT * FROM likes WHERE imageID=$imageId1 AND likerID=$id";
                        	if ($con->query($sql2)->num_rows > 0) {
                        		$div1 .= '
                        			<input type="button" id="Unlike" title="Liked" class="btn btn-sm btn-outline-light" value="❤" style="background: rgba(255,255,255,0.6); margin-top: 4.1px; width: 55px;" onclick="ajaxExplore2_3('.$imageId1.','.$uid.','.$NoOfLikes.')">
                        		';
                        	}else{
                        		$div1 .= '
                        			<input type="button" id="Like" title="Like" class="btn btn-sm btn-outline-light" value="👍" style="background: rgba(255,255,255,0.6); margin-top: 4.1px; width: 55px;" onclick="ajaxExplore2_2('.$imageId1.','.$uid.','.$NoOfLikes.')">
                        		';
                        	}
                        	$div1 .= '
                        	</div>
                        	<div class="col-md-6">
                        		<input type="text" id="newCommentt'.$imageId1.'" placeholder="Add a comment... (Max 100 characters)" style="margin-left: -30px; margin-top: 4px; width: 215px; height: 31px; font-size: 11px; overflow-y: hidden; padding-left: 4px;     background: rgba(0,0,255,0.11); color: whitesmoke;" maxlength="100" class="form-control">
                        	</div>
                        	<div class="col-md-3">
                        		<input type="button" id="Comment" class="btn btn-sm btn-outline-light" title="Comment" value="💬" style="background: rgba(255,255,255,0.6); margin-top: 4.1px; width: 55px;" onclick="ajaxExplore2_4('.$imageId1.','.$uid.','.$NoOfComments.','.$imageId1.')">
                        	</div>
                        </div>

                      </div>
                    </div>
                          
                    </div>
                  ';

                  $n++;

                }

    echo $div1;

?>