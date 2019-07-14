<?php
  
  if(session_start()){
    session_unset();
    session_destroy();
  }
  
?>

<?php

	if(isset($_POST['Submit'])){

		include("database.php");

		// Getting values from log in form fields
		$username = $_POST['username'];
		$password = $_POST['password'];

    // Escape User Input to help prevent SQL Injection
    $username = mysqli_real_escape_string($con,$username);
    $password = mysqli_real_escape_string($con,$password);

    $username = strtolower($username);
    $password = strtolower($password);

		// Start the session
		session_start();

		$rs = mysqli_query ($con, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
		if (mysqli_num_rows($rs) == 0){
			echo "
				<script type=\"text/javascript\">
					alert(\"Invalid Username Or Password!\");
					window.history.back();
				</script>
			";
			exit;
		}

		$sql = "SELECT * FROM admin WHERE username = '$username'";
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
			location.href = 'dashboard.php';
			</script>
		";
		}
?>

<html>

  <head>

    <!-- Title -->
    <title>Admin | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/index.css">

    <!-- Javascript for validation -->
    <script src="validations/index.js"></script>

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
          <img class="d-block w-100" style="box-shadow: 0 0.5rem 1rem rgba(255, 255, 255, 0.04) !important;" src="img/1.jpg">
          <br/><br/>

        </div>

        <div class="col-md-6">

          <br/>
          <div class="jumbotron shadow">

            <center>

              <h2><b>Gorgeous Snaps</b></h2>
              <p style="font-size: larger;">Administrator Login</p>
              <hr>
              <form name="loginform" action="index.php" method="post" onsubmit="return validate()">

                <div class="form-group">
                  
                  <input type="text" name="username" id="username" placeholder="Username" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">

                </div>

                <div class="form-group">
                  
                  <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">

                </div>

                <hr style="background: white;">

                <input type="submit" name="Submit" value="Log In" class="btn btn-primary loginbtn">

              </form>

            </center>

          </div>

        </div>

      </div>
    
    </div>

  </body>

</html>