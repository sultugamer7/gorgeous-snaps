<html>

	<head>

		<!-- Title -->
		<title>Dashboard | Gorgeous Snaps</title>

		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="styles/dashboard.css">

		<!-- CanvasJS -->
		<script src="canvasjs/canvasjs.min.js"></script>

	</head>

	<body class="bodycolor">

		<!-- Header -->
		<?php
		include("header.php");
		?>

		<div class="top">

		</div>

		<div class="row" style="margin-top: -18px; border-top-style: ridge; height: 548px; width: 1295px;">
			
			<div class="col-md-2" style="background: white; border-right-style: ridge;">
				<!-- Vertical Nav pills -->
				<ul class="nav flex-column">
					<li class="nav-item">
						<label style="margin-left: 1rem; font-family: -webkit-body; margin-top: 1rem; font-size: 18px; color: darkgray;">
							Admin Dashboard
						</label>
					</li>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="pill" href="#summary">Summary</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#users">Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#posts">Posts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#activities">Activities</a>
					</li>
				</ul>
			</div>

			<div class="col-md-10" style="background: #f2edf3;">
				
				<!-- Tab panes -->
				<div class="tab-content">

					<!-- Displaying Summary -->
					<div class="tab-pane container active" id="summary">
						<label style="color: darkred;">Summary</label>

						<!-- Displaying user summary -->
						<div class="row vertical-align">

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/5.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT id FROM users";
										$result = $con->query($sql);
										$userCount = 0;
										while ($row = $result->fetch_assoc()) {
											$userCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Users :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$userCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									
									<center>
									<div id="summaryResult1" style="height: 378px; width: 90%; margin-top: -7.5px;">
										<?php
											$dataPoint = array(0, 0, 0, 0, 0, 0, 0);
 											$dataTitle = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
 											$getDate = date("Y-m-d");
 											$dataTitle[0] = $getDate;
 											$j = 0;
 											for($j; $j<=6; $j++){
 												$sql = "SELECT * FROM users WHERE regdate BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59'";
 												$result = $con->query($sql);
 												$i = 0;
 												if($result->num_rows > 0){
 													while($row = $result->fetch_assoc()){
 														$i++;
 													}
 													$dataPoint[$j] = $i;
 												}
 												else{
 													$dataPoint[$j] = $i;
 												}
 												$getDate = date('Y-m-d', (strtotime('-1 day', strtotime($getDate))));
 											}
 											
 											$dataTitle[0] = date('l', (strtotime($dataTitle[0])));
 											$dataTitle[1] = date('l', (strtotime('-1 day', strtotime($dataTitle[0]))));
 											$dataTitle[2] = date('l', (strtotime('-2 day', strtotime($dataTitle[0]))));
 											$dataTitle[3] = date('l', (strtotime('-3 day', strtotime($dataTitle[0]))));
 											$dataTitle[4] = date('l', (strtotime('-4 day', strtotime($dataTitle[0]))));
 											$dataTitle[5] = date('l', (strtotime('-5 day', strtotime($dataTitle[0]))));
 											$dataTitle[6] = date('l', (strtotime('-6 day', strtotime($dataTitle[0]))));

											$dataPoints1 = array(
												array("y" => $dataPoint[6], "label" => $dataTitle[6]),
												array("y" => $dataPoint[5], "label" => $dataTitle[5]),
												array("y" => $dataPoint[4], "label" => $dataTitle[4]),
												array("y" => $dataPoint[3], "label" => $dataTitle[3]),
												array("y" => $dataPoint[2], "label" => $dataTitle[2]),
												array("y" => $dataPoint[1], "label" => $dataTitle[1]),
												array("y" => $dataPoint[0], "label" => $dataTitle[0])
											);
											 
										?>

										<script>
											function chart1() {
											 
												var chart1 = new CanvasJS.Chart("summaryResult1", {
													title: {
														text: "Users joined in the past week"
													},
													axisY: {
														title: "Number of Users"
													},
													data: [{
														type: "line",
														dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
													}]
												});
												chart1.render();
											 
											}
										</script>
										
									</div>
								</center>
								</div>
							</div>
						</div>

						<!-- Displaying posts summary -->
						<div class="row vertical-align">

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									
									<center>
									<div id="summaryResult2" style="height: 378px; width: 90%; margin-top: -7.5px;">
										<?php
 											$dataPoint = array(0, 0, 0, 0, 0, 0, 0);
 											$dataTitle = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
 											$getDate = date("Y-m-d");
 											$dataTitle[0] = $getDate;
 											$j = 0;
 											for($j; $j<=6; $j++){
 												$sql = "SELECT * FROM posts WHERE datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59'";
 												$result = $con->query($sql);
 												$i = 0;
 												if($result->num_rows > 0){
 													while($row = $result->fetch_assoc()){
 														$i++;
 													}
 													$dataPoint[$j] = $i;
 												}
 												else{
 													$dataPoint[$j] = $i;
 												}
 												$getDate = date('Y-m-d', (strtotime('-1 day', strtotime($getDate))));
 											}

 											$dataTitle[0] = date('l', (strtotime($dataTitle[0])));
 											$dataTitle[1] = date('l', (strtotime('-1 day', strtotime($dataTitle[0]))));
 											$dataTitle[2] = date('l', (strtotime('-2 day', strtotime($dataTitle[0]))));
 											$dataTitle[3] = date('l', (strtotime('-3 day', strtotime($dataTitle[0]))));
 											$dataTitle[4] = date('l', (strtotime('-4 day', strtotime($dataTitle[0]))));
 											$dataTitle[5] = date('l', (strtotime('-5 day', strtotime($dataTitle[0]))));
 											$dataTitle[6] = date('l', (strtotime('-6 day', strtotime($dataTitle[0]))));

											$dataPoints2 = array(
												array("y" => $dataPoint[6], "label" => $dataTitle[6]),
												array("y" => $dataPoint[5], "label" => $dataTitle[5]),
												array("y" => $dataPoint[4], "label" => $dataTitle[4]),
												array("y" => $dataPoint[3], "label" => $dataTitle[3]),
												array("y" => $dataPoint[2], "label" => $dataTitle[2]),
												array("y" => $dataPoint[1], "label" => $dataTitle[1]),
												array("y" => $dataPoint[0], "label" => $dataTitle[0])
											);
											 
										?>

										<script>
											function chart2() {
											 
												var chart2 = new CanvasJS.Chart("summaryResult2", {
													title: {
														text: "Posts uploaded in the past week"
													},
													axisY: {
														title: "Number of Posts"
													},
													data: [{
														type: "line",
														dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
													}]
												});
												chart2.render();
											 
											}
										</script>
										
									</div>
								</center>
								</div>
							</div>

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/6.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT id FROM posts";
										$result = $con->query($sql);
										$postCount = 0;
										while ($row = $result->fetch_assoc()) {
											$postCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Posts :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$postCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>
							
						</div>

						<!-- Displaying likes summary -->
						<div class="row vertical-align">

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/7.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT notificationID FROM notifications WHERE notificationType='Like'";
										$result = $con->query($sql);
										$likeCount = 0;
										while ($row = $result->fetch_assoc()) {
											$likeCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Likes :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$likeCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>
							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									
									<center>
									<div id="summaryResult3" style="height: 378px; width: 90%; margin-top: -7.5px;">
										<?php
 											$dataPoint = array(0, 0, 0, 0, 0, 0, 0);
 											$dataTitle = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
 											$getDate = date("Y-m-d");
 											$dataTitle[0] = $getDate;
 											$j = 0;
 											for($j; $j<=6; $j++){
 												$sql = "SELECT * FROM notifications WHERE notificationType='Like' AND datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59'";
 												$result = $con->query($sql);
 												$i = 0;
 												if($result->num_rows > 0){
 													while($row = $result->fetch_assoc()){
 														$i++;
 													}
 													$dataPoint[$j] = $i;
 												}
 												else{
 													$dataPoint[$j] = $i;
 												}
 												$getDate = date('Y-m-d', (strtotime('-1 day', strtotime($getDate))));
 											}

 											$dataTitle[0] = date('l', (strtotime($dataTitle[0])));
 											$dataTitle[1] = date('l', (strtotime('-1 day', strtotime($dataTitle[0]))));
 											$dataTitle[2] = date('l', (strtotime('-2 day', strtotime($dataTitle[0]))));
 											$dataTitle[3] = date('l', (strtotime('-3 day', strtotime($dataTitle[0]))));
 											$dataTitle[4] = date('l', (strtotime('-4 day', strtotime($dataTitle[0]))));
 											$dataTitle[5] = date('l', (strtotime('-5 day', strtotime($dataTitle[0]))));
 											$dataTitle[6] = date('l', (strtotime('-6 day', strtotime($dataTitle[0]))));

											$dataPoints3 = array(
												array("y" => $dataPoint[6], "label" => $dataTitle[6]),
												array("y" => $dataPoint[5], "label" => $dataTitle[5]),
												array("y" => $dataPoint[4], "label" => $dataTitle[4]),
												array("y" => $dataPoint[3], "label" => $dataTitle[3]),
												array("y" => $dataPoint[2], "label" => $dataTitle[2]),
												array("y" => $dataPoint[1], "label" => $dataTitle[1]),
												array("y" => $dataPoint[0], "label" => $dataTitle[0])
											);
											 
										?>

										<script>
											function chart3() {
											 
												var chart3 = new CanvasJS.Chart("summaryResult3", {
													title: {
														text: "Posts liked in the past week"
													},
													axisY: {
														title: "Number of Likes"
													},
													data: [{
														type: "line",
														dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
													}]
												});
												chart3.render();
											 
											}
										</script>
										
									</div>
								</center>
								</div>
							</div>
							
						</div>

						<!-- Displaying comments summary -->
						<div class="row vertical-align">

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									
									<center>
									<div id="summaryResult4" style="height: 378px; width: 90%; margin-top: -7.5px;">
										<?php
 											$dataPoint = array(0, 0, 0, 0, 0, 0, 0);
 											$dataTitle = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
 											$getDate = date("Y-m-d");
 											$dataTitle[0] = $getDate;
 											$j = 0;
 											for($j; $j<=6; $j++){
 												$sql = "SELECT * FROM notifications WHERE notificationType='Comment' AND datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59'";
 												$result = $con->query($sql);
 												$i = 0;
 												if($result->num_rows > 0){
 													while($row = $result->fetch_assoc()){
 														$i++;
 													}
 													$dataPoint[$j] = $i;
 												}
 												else{
 													$dataPoint[$j] = $i;
 												}
 												$getDate = date('Y-m-d', (strtotime('-1 day', strtotime($getDate))));
 											}

 											$dataTitle[0] = date('l', (strtotime($dataTitle[0])));
 											$dataTitle[1] = date('l', (strtotime('-1 day', strtotime($dataTitle[0]))));
 											$dataTitle[2] = date('l', (strtotime('-2 day', strtotime($dataTitle[0]))));
 											$dataTitle[3] = date('l', (strtotime('-3 day', strtotime($dataTitle[0]))));
 											$dataTitle[4] = date('l', (strtotime('-4 day', strtotime($dataTitle[0]))));
 											$dataTitle[5] = date('l', (strtotime('-5 day', strtotime($dataTitle[0]))));
 											$dataTitle[6] = date('l', (strtotime('-6 day', strtotime($dataTitle[0]))));

											$dataPoints4 = array(
												array("y" => $dataPoint[6], "label" => $dataTitle[6]),
												array("y" => $dataPoint[5], "label" => $dataTitle[5]),
												array("y" => $dataPoint[4], "label" => $dataTitle[4]),
												array("y" => $dataPoint[3], "label" => $dataTitle[3]),
												array("y" => $dataPoint[2], "label" => $dataTitle[2]),
												array("y" => $dataPoint[1], "label" => $dataTitle[1]),
												array("y" => $dataPoint[0], "label" => $dataTitle[0])
											);
											 
										?>

										<script>
											function chart4() {
											 
												var chart4 = new CanvasJS.Chart("summaryResult4", {
													title: {
														text: "Comments made on Posts in the past week"
													},
													axisY: {
														title: "Number of Comments"
													},
													data: [{
														type: "line",
														dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
													}]
												});
												chart4.render();
											 
											}
										</script>
										
									</div>
								</center>
								</div>
							</div>

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/8.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT notificationID FROM notifications WHERE notificationType='Comment'";
										$result = $con->query($sql);
										$commentCount = 0;
										while ($row = $result->fetch_assoc()) {
											$commentCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Comments :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$commentCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>
							
						</div>

						<!-- Displaying follows summary -->
						<div class="row vertical-align">

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/9.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT notificationID FROM notifications WHERE notificationType='Follow'";
										$result = $con->query($sql);
										$followCount = 0;
										while ($row = $result->fetch_assoc()) {
											$followCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Follows :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$followCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>
							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									
									<center>
									<div id="summaryResult5" style="height: 378px; width: 90%; margin-top: -7.5px;">
										<?php
 											$dataPoint = array(0, 0, 0, 0, 0, 0, 0);
 											$dataTitle = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
 											$getDate = date("Y-m-d");
 											$dataTitle[0] = $getDate;
 											$j = 0;
 											for($j; $j<=6; $j++){
 												$sql = "SELECT * FROM notifications WHERE notificationType='Follow' AND datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59'";
 												$result = $con->query($sql);
 												$i = 0;
 												if($result->num_rows > 0){
 													while($row = $result->fetch_assoc()){
 														$i++;
 													}
 													$dataPoint[$j] = $i;
 												}
 												else{
 													$dataPoint[$j] = $i;
 												}
 												$getDate = date('Y-m-d', (strtotime('-1 day', strtotime($getDate))));
 											}

 											$dataTitle[0] = date('l', (strtotime($dataTitle[0])));
 											$dataTitle[1] = date('l', (strtotime('-1 day', strtotime($dataTitle[0]))));
 											$dataTitle[2] = date('l', (strtotime('-2 day', strtotime($dataTitle[0]))));
 											$dataTitle[3] = date('l', (strtotime('-3 day', strtotime($dataTitle[0]))));
 											$dataTitle[4] = date('l', (strtotime('-4 day', strtotime($dataTitle[0]))));
 											$dataTitle[5] = date('l', (strtotime('-5 day', strtotime($dataTitle[0]))));
 											$dataTitle[6] = date('l', (strtotime('-6 day', strtotime($dataTitle[0]))));

											$dataPoints5 = array(
												array("y" => $dataPoint[6], "label" => $dataTitle[6]),
												array("y" => $dataPoint[5], "label" => $dataTitle[5]),
												array("y" => $dataPoint[4], "label" => $dataTitle[4]),
												array("y" => $dataPoint[3], "label" => $dataTitle[3]),
												array("y" => $dataPoint[2], "label" => $dataTitle[2]),
												array("y" => $dataPoint[1], "label" => $dataTitle[1]),
												array("y" => $dataPoint[0], "label" => $dataTitle[0])
											);
											 
										?>

										<script>
											function chart5() {
											 
												var chart5 = new CanvasJS.Chart("summaryResult5", {
													title: {
														text: "Users followed in the past week"
													},
													axisY: {
														title: "Number of Follows"
													},
													data: [{
														type: "line",
														dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
													}]
												});
												chart5.render();
											 
											}
										</script>
										
									</div>
								</center>
								</div>
							</div>
							
						</div>

					</div>

					<!-- Displaying Users -->
					<div class="tab-pane container fade" id="users">
						<label style="color: darkred;">Users</label>
						<div class="row">

							<div class="col-lg-4">

								<!-- Total users -->
								<div class="jumbotron" style="background-image: url('img/2.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT id FROM users";
										$result = $con->query($sql);
										$userCount = 0;
										while ($row = $result->fetch_assoc()) {
											$userCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Users :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$userCount.'</label>
										';
									?>

								</div>

								<!-- Users joined today -->
								<div class="jumbotron" style="background-image: url('img/2.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$getDate = date("Y/m/d");
										$sql1 = "SELECT id FROM users WHERE regdate BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59' ORDER BY id";
										$result1 = $con->query($sql1);
										$newUserCount = 0;
										while ($row1 = $result1->fetch_assoc()) {
											$newUserCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Users Joined Today :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$newUserCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									<div class="row" style="margin-top: -56px; margin-left: -30px;">

										<div class="col-lg-6">
											<label style="font-size: 13px;">
												Search by username :
											</label> 
											<input type="text" class="form-control" id="username" placeholder="Username" style="width: 285px; margin-left: 0px; height: 30px; font-size: 13px; margin-top: -6px;" autocomplete="off" onkeyup="ajaxDashboard1()">
										</div>

										<div class="col-lg-6" style="padding-left: 0; padding-right: 0px;">
											<label style="font-size: 13px; margin-left: 4px;">
												Search by registered date :
											</label>
											<div class="row vertical-align">
												<div class="col-lg-1">
													<label style="font-size: 12px; margin-left: 5px;">From:</label>
												</div>
												<div class="col-lg-5">
													<input type="date" id="fromDate" class="form-control" style="width: 128px; margin-left: 8px; height: 30px; font-size: 11px; margin-top: -6px;" value="2018-12-02" onkeyup="ajaxDashboard1();" onclick="ajaxDashboard1();">
												</div>
												<label style="font-size: 12px; margin-left: 14px;">To:</label>
												<div class="col-lg-5">
													<input type="date" id="toDate" class="form-control" style="width: 128px; margin-left: -12px; height: 30px; font-size: 11px; margin-top: -6px;" value="<?php echo date("Y-m-d");?>" onkeyup="ajaxDashboard1();" onclick="ajaxDashboard1();">
												</div>
											</div>
										</div>
									</div>
									<hr style="background: white; margin-left: -31px; width: 677px;">
									<div id="userResult"></div>
								</div>
							</div>
						</div>
					</div>
					<!--AJAX for displaying users-->
					<script language = "javascript" type = "text/javascript">
			        	<!-- 
						function ajaxDashboard1() {
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
			            			var ajaxDisplay = document.getElementById('userResult');
			            			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			            		}
			            	}
			            	// Now get the value from user and pass it to
			            	// server script.
			            	var username = document.getElementById('username').value;
			            	var fromDate = document.getElementById('fromDate').value;
			            	var toDate = document.getElementById('toDate').value;
			            	ajaxRequest.open("GET", "ajax/ajaxDashboard1.php?username="+username+"&fromDate="+fromDate+"&toDate="+toDate, true);
			            	ajaxRequest.send(null); 
			        	}
			        	//-->
			    	</script>

					<!-- Displaying Posts -->
					<div class="tab-pane container fade" id="posts">
						<label style="color: darkred;">Posts</label>
						<div class="row">

							<div class="col-lg-4">

								<!-- Total posts -->
								<div class="jumbotron" style="background-image: url('img/3.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT id FROM posts";
										$result = $con->query($sql);
										$postCount = 0;
										while ($row = $result->fetch_assoc()) {
											$postCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Total Posts :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$postCount.'</label>
										';
									?>

								</div>

								<!-- Today's posts -->
								<div class="jumbotron" style="background-image: url('img/3.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$getDate = date("Y/m/d");
										$sql1 = "SELECT id FROM posts WHERE datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59' ORDER BY id";
										$result1 = $con->query($sql1);
										$newPostCount = 0;
										while ($row1 = $result1->fetch_assoc()) {
											$newPostCount++;
										}
										echo '
										<label style="color: aliceblue; margin-top: -36px; font-size: 18px;">Posts Uploaded Today :</label><br/>
										<label style="color: aliceblue; font-size: 37px; margin-top: -8px;">'.$newPostCount.'</label>
										';
									?>

								</div>
								
							</div>

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									<div class="row" style="margin-top: -56px; margin-left: -30px;">

										<div class="col-lg-6">
											<label style="font-size: 13px;">
												Search by username :
											</label> 
											<input type="text" class="form-control" id="username1" placeholder="Username" style="width: 285px; margin-left: 0px; height: 30px; font-size: 13px; margin-top: -6px;" autocomplete="off" onkeyup="ajaxDashboard2()">
										</div>

										<div class="col-lg-6" style="padding-left: 0; padding-right: 0px;">
											<label style="font-size: 13px; margin-left: 4px;">
												Search by date posted :
											</label>
											<div class="row vertical-align">
												<div class="col-lg-1">
													<label style="font-size: 12px; margin-left: 5px;">From:</label>
												</div>
												<div class="col-lg-5">
													<input type="date" id="fromDate1" class="form-control" style="width: 128px; margin-left: 8px; height: 30px; font-size: 11px; margin-top: -6px;" value="2018-12-02" onkeyup="ajaxDashboard2();" onclick="ajaxDashboard2();">
												</div>
												<label style="font-size: 12px; margin-left: 14px;">To:</label>
												<div class="col-lg-5">
													<input type="date" id="toDate1" class="form-control" style="width: 128px; margin-left: -12px; height: 30px; font-size: 11px; margin-top: -6px;" value="<?php echo date("Y-m-d");?>" onkeyup="ajaxDashboard2();" onclick="ajaxDashboard2();">
												</div>
											</div>
										</div>
									</div>
									<hr style="background: white; margin-left: -31px; width: 677px;">
									<div id="postResult"></div>
								</div>
							</div>
						</div>
					</div>
					<!--AJAX for displaying posts-->
					<script language = "javascript" type = "text/javascript">
			        	<!-- 
						function ajaxDashboard2() {
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
			            			var ajaxDisplay = document.getElementById('postResult');
			            			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			            		}
			           	    }
			            	// Now get the value from user and pass it to
			           	    // server script.
			            	var username = document.getElementById('username1').value;
			            	var fromDate = document.getElementById('fromDate1').value;
			            	var toDate = document.getElementById('toDate1').value;
			            	ajaxRequest.open("GET", "ajax/ajaxDashboard2.php?username="+username+"&fromDate="+fromDate+"&toDate="+toDate, true);
			            	ajaxRequest.send(null); 
			        	}
			        	//-->
			    	</script>

					<!-- Displaying Activities -->
					<div class="tab-pane container fade" id="activities">
						<label style="color: darkred;">Activities</label>
						<div class="row">

							<div class="col-lg-4">

								<!-- Total activities -->
								<div class="jumbotron" style="background-image: url('img/4.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$sql = "SELECT notificationID FROM notifications";
										$result = $con->query($sql);
										$notificationsCount = 0;
										while ($row = $result->fetch_assoc()) {
											$notificationsCount++;
										}
										echo '
										<label style="color: brown; margin-top: -36px; font-size: 18px;">Total Activities :</label><br/>
										<label style="color: brown; font-size: 37px; margin-top: -8px;">'.$notificationsCount.'</label>
										';
									?>

								</div>

								<!-- New activities -->
								<div class="jumbotron" style="background-image: url('img/4.jpg'); width: 300; border-radius: 0; height: 170px; object-fit: cover">
									
									<?php
										$getDate = date("Y/m/d");
										$sql1 = "SELECT notificationID FROM notifications WHERE datetime BETWEEN '$getDate 00:00:00' AND '$getDate 23:59:59' ORDER BY notificationID";
										$result1 = $con->query($sql1);
										$newActivitiesCount = 0;
										while ($row1 = $result1->fetch_assoc()) {
											$newActivitiesCount++;
										}
										echo '
										<label style="color: brown; margin-top: -36px; font-size: 18px; margin-left: -12px; width: 280px;">Activities Performed Today :</label><br/>
										<label style="color: brown; font-size: 37px; margin-top: -8px;">'.$newActivitiesCount.'</label>
										';
									?>

								</div>
								<br/>

							</div>

							<div class="col-lg-8">
								<div class="jumbotron" style="margin-left: -18px; width: 680px; border-radius: 0; height: 481.5px;">
									<div class="row" style="margin-top: -56px; margin-left: -30px;">

										<div class="col-lg-6">
											<label style="font-size: 13px;">
												Search by username :
											</label> 
											<input type="text" class="form-control" id="username2" placeholder="Username" style="width: 285px; margin-left: 0px; height: 30px; font-size: 13px; margin-top: -6px;" autocomplete="off" onkeyup="ajaxDashboard3()">
										</div>

										<div class="col-lg-6" style="padding-left: 0; padding-right: 0px;">
											<label style="font-size: 13px; margin-left: 4px;">
												Search by date :
											</label>
											<div class="row vertical-align">
												<div class="col-lg-1">
													<label style="font-size: 12px; margin-left: 5px;">From:</label>
												</div>
												<div class="col-lg-5">
													<input type="date" id="fromDate2" class="form-control" style="width: 128px; margin-left: 8px; height: 30px; font-size: 11px; margin-top: -6px;" value="2018-12-02" onkeyup="ajaxDashboard3();" onclick="ajaxDashboard3();">
												</div>
												<label style="font-size: 12px; margin-left: 14px;">To:</label>
												<div class="col-lg-5">
													<input type="date" id="toDate2" class="form-control" style="width: 128px; margin-left: -12px; height: 30px; font-size: 11px; margin-top: -6px;" value="<?php echo date("Y-m-d");?>" onkeyup="ajaxDashboard3();" onclick="ajaxDashboard3();">
												</div>
											</div>
										</div>
									</div>
									<hr style="background: white; margin-left: -31px; width: 677px;">
									<div id="activitiesResult"></div>
								</div>
							</div>
						</div>
					</div>
					<!--AJAX for displaying activities-->
					<script language = "javascript" type = "text/javascript">
			        	<!-- 
						function ajaxDashboard3() {
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
			            			var ajaxDisplay = document.getElementById('activitiesResult');
			            			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			            		}
			           	    }
			            	// Now get the value from user and pass it to
			           	    // server script.
			            	var username = document.getElementById('username2').value;
			            	var fromDate = document.getElementById('fromDate2').value;
			            	var toDate = document.getElementById('toDate2').value;
			            	ajaxRequest.open("GET", "ajax/ajaxDashboard3.php?username="+username+"&fromDate="+fromDate+"&toDate="+toDate, true);
			            	ajaxRequest.send(null); 
			        	}
			        	//-->
			    	</script>

			</div>

		</div>

<?php /*
			

			<hr style="background: white;">

			<!-- Tab panes -->
			<div class="tab-content">				

				<!-- Displaying posts -->
				<div class="tab-pane container fade" id="posts">
					
					<div class="row">
						<div class="col-lg-6">
							<b>Search by username :</b> <input type="text" class="form-control" id="username1" placeholder="Username" style="width: 400; margin-left: 1px;" autocomplete="off" onkeyup="ajaxDashboard2()">
						</div>
						<div class="col-lg-6">
							<b>Search by date : </b>
							<div class="row vertical-align">
								<div class="col-lg-1">From:</div>
								<div class="col-lg-5"> <input type="date" id="fromDate1" class="form-control" value="2018-12-02" onkeyup="ajaxDashboard2()"></div>
								<div class="col-lg-1">To:</div>
								<div class="col-lg-5"> <input type="date" id="toDate1" class="form-control" style="margin-left: -21px;" value="<?php echo date("Y-m-d");?>" onkeyup="ajaxDashboard2()"></div>
							</div>
						</div>
					</div>

					<hr style="background: white;">

					<div id="postResult"></div>

				</div>
				

				<div class="tab-pane container fade" id="likes">
					
				</div>

				<div class="tab-pane container fade" id="comments">
					
				</div>

				<div class="tab-pane container fade" id="following">
					
				</div>

			</div>

		</div>
		*/?>


	</body>

</html>

<script>

	$(document).ready(function(){
		ajaxDashboard1();
		ajaxDashboard2();
		ajaxDashboard3();
		chart1();
		chart2();
		chart3();
		chart4();
		chart5();
		
	});
	
</script>