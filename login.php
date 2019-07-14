<?php

	if(isset($_POST['Submit'])){

		include("database.php");

		// Getting values from log in form fields
		$username = urlencode(utf8_encode($_POST['username']));
		$password = $_POST['password'];

    // Escape User Input to help prevent SQL Injection
    $username = mysqli_real_escape_string($con,$username);
    $password = mysqli_real_escape_string($con,$password);

    $username = strtolower($username);
    $password = strtolower($password);

		// Start the session
		session_start();

		$rs = mysqli_query ($con, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
		if (mysqli_num_rows($rs) == 0){
			echo "
				<script type=\"text/javascript\">
					alert(\"Invalid Username Or Password!\");
					window.history.back();
				</script>
			";
			exit;
		}

		$sql = "SELECT * FROM users WHERE username = '$username'";
	  	$result = $con->query($sql);
	  	if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$id = $row['id'];
		    }
		}

		// Saving id
		$_SESSION['id'] = $id;

		echo "
			<script type=\"text/javascript\">
			location.href = 'feed.php';
			</script>
		";
		}
?>

<html>

  <head>

    <!-- Title -->
    <title>Log In | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/login.css">

    <!-- Javascript for validation -->
    <script src="validations/login.js"></script>

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
      include("header.php");
    ?>

    <div class="top">

    </div>

    <!-- Log In -->
    <div class="container">
      
      <div class="row vertical-align">
        
        <div class="col-md-6">

          <br/><br/>
          <img class="d-block w-100 shadow" src="img/7.jpg">
          <br/><br/>

        </div>

        <div class="col-md-6">

          <br/>
          <div class="jumbotron shadow">

            <center>

              <h2><b>Gorgeous Snaps</b></h2>
              <p>Log in now to see photos from your friends and to share photos with them and the World!</p>
              <br/>
              <hr>
              <form name="loginform" method="post" onsubmit="return validate()">

                <div class="form-group">
                  
                  <input type="text" name="username" id="username" placeholder="Username" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">

                </div>

                <div class="form-group">
                  
                  <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">

                </div>

                <input type="submit" name="Submit" value="Log In" class="btn btn-primary btn-sm loginbtn">

                <hr style="margin-top: 14px;">
                <br/>

                Don't have an account?
                <a href="signup.php" role="button">Sign Up</a>

              </form>

            </center>

          </div>

        </div>

      </div>
    
    </div>

    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>