<html>

  <head>

    <?php
      include("bootstrap.php");
    ?>

    <style type="text/css">
      .btn-color{
        color: white;
      }
      .navbar{
        background: rgba(255,255, 255, 1);
      }
      .btn-link {
        color: black !important;
      }
      .vertical-align {
		display: flex;
		align-items: center;
	  }

      .btna{
      	background: rgba(250, 190, 220, 0.0);
      }
      .btna:hover {
		  background: rgba(250, 190, 220, 0.25);
	   }


    </style>
    

    <script type="text/javascript">
      
      function logoutConfirmation(){

        var bool = confirm("Are you sure?");
        if(bool == false){
          return false;
        }else{
          return true;
        }
      }

    </script>

  </head>

  <body>

    <form method="post">

      <!-- Fixed Transparent Navigation Bar -->
      <nav class="navbar navbar-expand navbar-dark fixed-top transparent" style="border-bottom-style: groove; border-bottom-width: 1;">
        
        <?php
          session_start();
          if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            include("getdata.php");
            echo '
              <a href="dashboard.php" class="navbar-brand text-dark font-weight-bold" style="padding-left: 25px;"><h4><b>Gorgeous Snaps</b></h4></a>

              <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto" style="padding-right: 25px;">
                	<li class="navbar-item" id="header2">
            ';

            
            echo '
            	  </li>
                  <li class="navbar-item">
                    <a href="adminProfile.php" title="Profile" class="btn btn-link">🤴</a>
                  </li>
                  <li class="navbar-item" style="padding-left: 13px;">
                      <input type="submit" name="logout" class="btn btn-dark" title="Log Out" value="🚪" onclick="return logoutConfirmation();">
                  </li>

                </ul>
                    
              </div>
              <!-- Getting values to pass to AJAX -->
        	  <input type="hidden" id="id" value="'.$id.'">
            ';

            if(isset($_POST['logout'])){
              session_unset();
              session_destroy();
              header("location:index.php");
              exit();
            }
            ?>
            <!-- AJAX -->
            <script language = "javascript" type = "text/javascript">
	    		<!-- 

	            // Get the values to pass it to server script.
	            var id = document.getElementById('id').value;
	            
	            // Displaying notifications by AJAX
	            function ajaxHeader2() {
	                var ajaxRequest;  // The variable that makes Ajax possible!

	                try {        
	                  	// Opera 8.0+, Firefox, Safari
	                  	ajaxRequest = new XMLHttpRequest();
	                  } catch (e) {

	                  	// Internet Explorer Browsers
	                  	try {
	                  		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	                  	} catch (e) {

	                  		try {
	                  			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	                  		} catch (e) {
	                      		// Something went wrong
	                      		alert("Your browser broke!");
	                      		return false;
	                      	}
	                      }
	                  }

	                	// Create a function that will receive data
	                	// sent from the server and will update
	                	// div section in the same page.
	                	ajaxRequest.onreadystatechange = function() {
	                		
	                		if(ajaxRequest.readyState == 4) {
	                			var ajaxDisplay = document.getElementById('header2');
	                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
	                		}
	                	}

	                ajaxRequest.open("GET", "ajax/ajaxHeader2.php?id="+id, true);
	                ajaxRequest.send(null); 
	            }

	            // Marking notifications as read by AJAX
	            function ajaxHeader3() {
	                var ajaxRequest;  // The variable that makes Ajax possible!

	                try {        
	                  	// Opera 8.0+, Firefox, Safari
	                  	ajaxRequest = new XMLHttpRequest();
	                  } catch (e) {

	                  	// Internet Explorer Browsers
	                  	try {
	                  		ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	                  	} catch (e) {

	                  		try {
	                  			ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	                  		} catch (e) {
	                      		// Something went wrong
	                      		alert("Your browser broke!");
	                      		return false;
	                      	}
	                      }
	                  }

	                	// Create a function that will receive data
	                	// sent from the server and will update
	                	// div section in the same page.
	                	ajaxRequest.onreadystatechange = function() {

	                		if(ajaxRequest.readyState == 4) {
	                			ajaxHeader2();
	                		}
	                	}

	                ajaxRequest.open("GET", "ajax/ajaxHeader3.php?id="+id, true);
	                ajaxRequest.send(null); 
	            }
	        </script>
            <?php
          }else{
              
            echo '
              <a href="index.php" class="navbar-brand text-dark font-weight-bold" style="padding-left: 25px;"><h4><b>Gorgeous Snaps</b></h4></a>
            ';
          }
            
        ?>
      
      </nav>

      <!-- Notification Modal -->
      <?php
      	if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
      ?>
      
      <div id="notificationModal" class="modal" role="document">

      	<div class="modal-dialog">

      		<!-- Modal content-->
      		<div class="modal-content">

      			<div class="modal-header">

      				<button type="button" class="close" data-dismiss="modal">&times;</button>

      			</div>

      			<div class="modal-body" id="header3">

      				<?php

			        	// Displaying unread notifications first
	      				$sql = "SELECT * FROM reports WHERE status != 1 ORDER BY reportID DESC LIMIT 30";
	      				$result = $con->query($sql);
	      				$i = 0;
	      				$reportID = array();
	      				$reporterID = array();
	      				$uid = array();
	      				$postID = array();
	      				if($result->num_rows > 0){

	      					while($row = $result->fetch_assoc()){
			        			// Getting values
			        			$reportID[$i] = $row['reportID'];
			        			$reporterID[$i] = $row['reporterID'];
			        			$uid[$i] = $row['uid'];
			        			$postID[$i] = $row['postID'];
			        			$datetime = $row['datetime'];

			        			// Displaying notification

			        			if($postID[$i] != null){
			        				// Getting username and profile pic of reporter
			        				$sql2 = "SELECT * FROM users WHERE id=$reporterID[$i]";
			        				$result2 = $con->query($sql2);
			        				$profilepic1 = '../';
			        				$username1 = '';
			        				while($row2 = $result2->fetch_assoc()){
			        					$profilepic1 .= $row2['image'];
			        					$username1 = $row2['username'];
			        				}
			        				if($profilepic1 == '../'){
			        					$profilepic1 = 'img/16.jpg';
			        				}

			        				// Getting username and profile pic of reported user
			        				$sql2 = "SELECT * FROM users WHERE id=$uid[$i]";
			        				$result2 = $con->query($sql2);
			        				$profilepic2 = '../';
			        				$username2 = '';
			        				while($row2 = $result2->fetch_assoc()){
			        					$profilepic2 .= $row2['image'];
			        					$username2 = $row2['username'];
			        				}
			        				if($profilepic2 == '../'){
			        					$profilepic2 = 'img/16.jpg';
			        				}

			        				// Getting the post
			        				$sql2 = "SELECT * FROM posts WHERE id=$postID[$i]";
			        				$result2 = $con->query($sql2);
			        				$post = '../';
			        				while($row2 = $result2->fetch_assoc()){
			        					$post .= $row2['image'];
			        				}

			        				echo "
			        					<div class='row vertical-align'>
			        						<div class='col-md-2'>
			        							<img src='$profilepic1' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle'>
			        						</div>
			        						<div class='col-md-8'>
			        							<div style='margin-top: 5px;'>
			        								<a href='#'><b>$username1</b></a> reported <a href='#'><b>$username2</b></a>'s post.
			        							</div>
			        							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
			        						</div>
			        						<div class='col-md-2' style='margin-left: -12px;'>
			        							<img src='$post' style='height: 55px; width: 60px; object-fit:cover;'>
			        						</div>
			        					</div>
			        					<input type='submit' class='btna' style='position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 495px; border: none; cursor: pointer;' value='' name='postNotification$i'>
			        				";
			        			}else{
			        				// Getting username and profile pic of reporter
			        				$sql2 = "SELECT * FROM users WHERE id=$reporterID[$i]";
			        				$result2 = $con->query($sql2);
			        				$profilepic1 = '../';
			        				$username1 = '';
			        				while($row2 = $result2->fetch_assoc()){
			        					$profilepic1 .= $row2['image'];
			        					$username1 = $row2['username'];
			        				}
			        				if($profilepic1 == '../'){
			        					$profilepic1 = 'img/16.jpg';
			        				}

			        				// Getting username and profile pic of reported user
			        				$sql2 = "SELECT * FROM users WHERE id=$uid[$i]";
			        				$result2 = $con->query($sql2);
			        				$profilepic2 = '../';
			        				$username2 = '';
			        				while($row2 = $result2->fetch_assoc()){
			        					$profilepic2 .= $row2['image'];
			        					$username2 = $row2['username'];
			        				}
			        				if($profilepic2 == '../'){
			        					$profilepic2 = 'img/16.jpg';
			        				}

			        				echo "
			        					<div class='row vertical-align'>
			        						<div class='col-md-2'>
			        							<img src='$profilepic1' style='height: 55px; width: 57px; object-fit:cover;' class='rounded-circle'>
			        						</div>
			        						<div class='col-md-8'>
			        							<div style='margin-top: 5px;'>
			        								<a href='#'><b>$username1</b></a> reported <a href='#'><b>$username2</b></a>'s profile.
			        							</div>
			        							<p style='font-size: 11px; color: red; font-weight: 450;'>$datetime</p>
			        						</div>
			        						<div class='col-md-2'>
			        							<img src='$profilepic2' style='height: 55px; width: 57px; object-fit:cover; margin-left: -8.5px;' class='rounded-circle'>
			        						</div>
			        					</div>
			        					<input type='submit' class='btna' style='position: absolute; margin-top: -61px; margin-left: -15px; height: 61px; width: 495px; border: none; cursor: pointer;' value='' name='profileNotification$i'>
			        				";
			        			}

			        			$i++;
			        		}

			        		for($j=0; $j<=$i; $j++){

			        			// For post report notification
			        			if(isset($_POST['postNotification'.$j])){
			        				$reporterID2 = $reporterID[$j];
			        				$uid2 = $uid[$j];
			        				$postID2 = $postID[$j];
			        				echo '
			        					<script>
			        						window.location.href = \'reportPost.php?reporterID='.$reporterID2.'&uid='.$uid2.'&postID='.$postID2.'\';
			        					</script>
			        				';
			        			}

			        			// For profile report notification
			        			if(isset($_POST['profileNotification'.$j])){
			        				$reporterID2 = $reporterID[$j];
			        				$uid2 = $uid[$j];
			        				echo '
			        					<script>
			        						window.location.href = \'reportUser.php?reporterID='.$reporterID2.'&uid='.$uid2.'\';
			        					</script>
			        				';
			        			}

			        		}

	      				}else{
	      					echo '
	      						<h5 style="font-family: cursive;">No notifications!</h5>
	      					';
	      				}

      				?>

      			</div>

      			<div class="modal-footer">

      				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

      			</div>

      		</div>

      	</div>

      </div>

      <?php
      	}
      ?>
      
    </form>


  </body>

</html>

<script>
	$(document).ready(function(){

		ajaxHeader2();
		setInterval(function(){ajaxHeader2();},1500);
	});
</script>