<?php
	include "database.php";
	$sql = "SELECT * FROM admin WHERE id=1";
	$result=$con->query($sql);
	$oldUsername = '';
	$oldPassword = '';
	while($row = $result->fetch_assoc()){
		$oldUsername = $row["username"];
		$oldPassword = $row["password"];
	}
?>
<html>

	<head>

		<!-- Title -->
		<title>Dashboard | Gorgeous Snaps</title>

		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="styles/adminProfile.css">

		<script type="text/javascript">
			function changeUsername(){
				var username = document.getElementById('username');
				if(username.value.length == 0){
					alert("Username Required!");
					username.focus();
					return false;
				}else{
					return true;
				}
			}
			function changePassword(){
				var currentPassword = document.getElementById('currentPassword');
				var newPassword = document.getElementById('newPassword');
				var confirmPassword = document.getElementById('confirmPassword');
				if(currentPassword.value.length == 0){
					alert("Current Password Required");
					currentPassword.focus();
					return false;
				}else{
					if(newPassword.value.length == 0){
						alert("New Password Required");
						newPassword.focus();
						return false;
					}else{
						if(confirmPassword.value.length == 0){
							alert("Confirm Your Password");
							confirmPassword.focus();
							return false;
						}else{
							if(currentPassword.value == newPassword.value){
								alert("New Password Must Be Different");
								newPassword.focus();
								return false;
							}else{
								if(newPassword.value != confirmPassword.value){
									alert("Password Does Not Matches");
									confirmPassword.focus();
									return false;
								}else{
									return true;
								}
							}
						}
					}
				}
			}
		</script>


	</head>

	<body class="bodycolor">

		<!-- Header -->
		<?php
			include("header.php");
		?>

		<div class="top"></div>
			<div class="container">
			<div class="row vertical-align">
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<div class="jumbotron jumbobgcolor">
						<form name="changeUsernameForm" method="post" action="adminProfile.php" onsubmit="return changeUsername();">
							<label>Username : </label>
							<center>
								<input type="text" name="username" id="username" class="form-control inputtype" placeholder="<?php echo $oldUsername; ?>" style="text-transform: lowercase;">
							</center>
							<br/>
							<center>
								<input type="submit" name="changeUsername1" value="Change Username" class="btn btn-primary">
							</center>
						</form>
					</div>
				</div>
				<div class="col-md-5">
					<div class="jumbotron jumbobgcolor">
						<form name="changePassForm" method="post" action="adminProfile.php" onsubmit="return changePassword();">
							<label>Current Password :</label>
							<center>
								<input type="password" name="currentPassword" id="currentPassword" class="form-control inputtype" style="text-transform: lowercase;">
							</center>
							<label>New Password :</label>
							<center>
								<input type="password" name="newPassword" id="newPassword" class="form-control inputtype" style="text-transform: lowercase;">
							</center>
							<label>Confirm Password :</label>
							<center>
								<input type="password" name="confirmPassword" id="confirmPassword" class="form-control inputtype" style="text-transform: lowercase;">
							</center>
							<br/>
							<center>
								<input type="submit" name="changePassword1" value="Change Password" class="btn btn-primary">
							</center>
						</form>
					</div>
					<?php 
						if(isset($_POST["changeUsername1"])){
							$newUsername = $_POST["username"];
							$newUsername = strtolower($newUsername);
							if($oldUsername == $newUsername){
								echo '
									<script>
										alert("Usrname already exists!");
										window.location.back();
									</script>
								';
								exit;
							}else{
								$sql2 = "UPDATE admin SET username='".$newUsername."' WHERE id=1";
								$result2 = $con->query($sql2);
								if($result2 == TRUE){
									echo '
										<script>
											alert("Username Changed!");
											window.location.href = "adminProfile.php";
										</script>
									';
									exit;
								}
							}
						}
						if(isset($_POST["changePassword1"])) {
							$currentPassword = $_POST["currentPassword"];
							$newPassword = $_POST["newPassword"];
							$currentPassword = strtolower($currentPassword);
							$newPassword = strtolower($newPassword);
							if($oldPassword != $currentPassword){
								echo '
									<script>
										alert("Invalid current password!");
										window.location.back();
									</script>
								';
								exit;
							}else{
								$sql2 = "UPDATE admin SET password='".$newPassword."' WHERE id=1";
								$result2 = $con->query($sql2);
								if($result2 == TRUE){
									echo '
										<script>
											alert("Password Changed!");
											window.location.href = "adminProfile.php";
										</script>
									';
									exit;
								}
							}
						}
					?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</body>

</html>