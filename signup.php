<?php

  if(isset($_POST['Submit'])){

    include("database.php");

    // Getting values from sign up form fields
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $firstname = strtolower($firstname);
    $firstname = ucfirst($firstname);
    $lastname = strtolower($lastname);
    $lastname = ucfirst($lastname);
    $email = strtolower($email);
    $username = strtolower($username);
    $password = strtolower($password);

    // Duplicate email validation
    $rs = mysqli_query ($con, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($rs) > 0){
      echo "
        <script type=\"text/javascript\">
          alert(\"E-Mail Address Already Exists!\");
          window.history.back();
        </script>
      ";
      exit;
    }

    // Duplicate username validation
    $rs = mysqli_query ($con, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($rs) > 0){
      echo "
        <script type=\"text/javascript\">
          alert(\"Username Already Exists!\");
          window.history.back();
        </script>
      ";
      exit;
    }

    // Adding user data to DB
    $sql = "INSERT INTO users(firstname,lastname,email,username,password) VALUES('$firstname','$lastname','$email','$username','$password')";
    // $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
    if($con->query($sql)==TRUE){
      echo "
        <script type=\"text/javascript\">
          alert(\"Account created successfully! You can log in now.\");
          location.href = 'login.php';
        </script>
      ";
    }else{
      echo "alert(Error : ".$sql.$con->error.")";
    }

    $sql = "SELECT * FROM users ORDER BY id ASC";
    $result = $con->query($sql);
    $uid = "";
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $uid = $row['id'];
      }
    }
    mkdir("images/posts/".$uid);

  }

?>

<html>

  <head>

    <!-- Title -->
    <title>Sign Up | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/signup.css">

    <!-- Javascript for validation -->
    <script src="validations/signup.js"></script>

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
      include("header.php");
    ?>

    <div class="top">

    </div>

    <!-- Sign Up -->
    <div class="container">
      
      <div class="row vertical-align">
        
        <div class="col-md-6">

          <br/><br/>
          <img class="d-block w-100 shadow" src="img/6.jpg">
          <br/><br/>

        </div>

        <div class="col-md-6">

          <br/>
          <div class="jumbotron shadow">

            <center>

              <h2><b>Gorgeous Snaps</b></h2>
              <p>Sign up to see photos from your friends and to share photos with them and the world!</p>
              <br/>
              <hr>

              <form name="signupform" action="signup.php" method="post" onsubmit="return validate()">
                
                <div class="form-group">
                  
                  <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control form-control-sm" style="width: 270px; text-transform: capitalize;">

                </div>

                <div class="form-group">
                  
                  <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control form-control-sm" style="width: 270px; text-transform: capitalize;">
                  
                </div>

                <div class="form-group">
                  
                  <input type="text" name="email" id="email" placeholder="E-Mail Address" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">
                  
                </div>

                <div class="form-group">
                  
                  <input type="text" name="username" id="username" placeholder="Username" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">
                  
                </div>

                <div class="form-group">
                  
                  <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-sm" style="width: 270px; text-transform: lowercase;">
                  
                </div>

                <input type="submit" name="Submit" value="Sign Up" class="btn btn-primary btn-sm signupbtn">

                <hr>
                <br/>

                Have an account?
                <a href="login.php" role="button">Log In</a>

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