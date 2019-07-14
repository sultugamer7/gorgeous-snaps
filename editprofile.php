<html>

  <head>

    <!-- Title -->
    <title>Edit Profile | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/editprofile.css">

    <!-- Javascript for validation -->
    <script src="validations/editprofile.js"></script>

  </head>

  <body>

    <!-- Header -->
    <?php
      include("header.php");
    ?>

    <div class="top">
      
    </div>

    <div class="container">
      
      <!-- Nav pills -->
      <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#editprofile">Edit Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#changepassword">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#changeprofilepicture">Change Profile Picture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#deleteaccount">Delete Account</a>
        </li>
      </ul>

      <hr>
      
      <!-- Tab panes -->
      <div class="tab-content">

        <div class="tab-pane container active" id="editprofile">

          <div class="row vertical-align">
        
            <div class="col-md-6">

              <img class="d-block w-100 shadow" src="img/6.jpg">
              <br/>

            </div>

            <div class="col-md-6">

              <br/>
              <div class="jumbotron shadow">

                <form name="editprofileform" method="post" onsubmit="return validate()">
                  
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <center>
                      <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" placeholder="<?php echo $firstname; ?>" style="width: 400px; text-transform: capitalize;">
                      <input type="hidden" name="firstname1" id="firstname1" value="<?php echo $firstname; ?>">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <center>
                      <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" placeholder="<?php echo $lastname; ?>" style="width: 400px; text-transform: capitalize;">
                      <input type="hidden" name="lastname1" id="lastname1" value="<?php echo $lastname; ?>">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <center>
                      <input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="<?php echo $email; ?>" style="width: 400px; text-transform: lowercase;">
                      <input type="hidden" name="email1" id="email1" value="<?php echo $email; ?>">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <center>
                      <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="<?php echo $username; ?>" style="width: 400px; text-transform: lowercase;">
                      <input type="hidden" name="username1" id="username1" value="<?php echo $username; ?>">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="bio">Bio</label>
                    <center>
                      <textarea rows="7" cols="50" name="bio" id="bio" class="form-control form-control-sm" placeholder="<?php echo $bio; ?>" maxlength="150" style="width: 400px;"></textarea>
                      <input type="hidden" name="bio1" id="bio1" value="<?php echo $bio; ?>">
                    </center>
                  </div>
                  <center>
                    <input type="submit" name="edit" id="edit" value="Submit" class="btn btn-primary btn-md">
                  </center>

                </form>

                <?php

                  if(isset($_POST['edit'])){

                    include("database.php");

                    // Getting values from sign up form fields
                    $id1 = $_POST['id'];
                    $firstname1 = $_POST['firstname'];
                    $lastname1 = $_POST['lastname'];
                    $email1 = $_POST['email'];
                    $username1 = $_POST['username'];
                    $bio1 = $_POST['bio'];

                    $bio1 = mysqli_real_escape_string($con,$bio1);

                    $firstname1 = strtolower($firstname1);
                    $firstname1 = ucfirst($firstname1);
                    $lastname1 = strtolower($lastname1);
                    $lastname1 = ucfirst($lastname1);
                    $email1 = strtolower($email1);
                    $username1 = strtolower($username1);

                    if($firstname1 != ""){
                      $sql = "UPDATE users SET firstname = '$firstname1' WHERE id = $id1";
                      $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
                    }

                    if($lastname1 != ""){
                      $sql = "UPDATE users SET lastname = '$lastname1' WHERE id = $id1";
                      $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
                    }

                    $a = true;
                    if($email1 != ""){
                      // Duplicate email validation
                      $sql = "SELECT * FROM users";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            $email2 = $row['email'];
                            if($email1 == $email2){
                              $a = false;
                              break;
                            }
                          }
                      }
                      if($a == true){
                        $sql = "UPDATE users SET email = '$email1' WHERE id = $id1";
                        $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
                      }else{
                        echo "
                          <script type=\"text/javascript\">
                            alert(\"E-Mail Address Already Exists!\");
                            window.history.back();
                          </script>
                        ";
                        exit;
                      }
                    }

                    $b = true;
                    if($username1 != ""){
                      // Duplicate username validation
                      $sql = "SELECT * FROM users";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            $username2 = $row['username'];
                            if($username1 == $username2){
                              $b = false;
                              break;
                            }
                          }
                      }
                      if($b == true){
                        $sql = "UPDATE users SET username = '$username1' WHERE id = $id1";
                        $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
                      }else{
                        echo "
                          <script type=\"text/javascript\">
                            alert(\"Username Already Exists!\");
                            window.history.back();
                          </script>
                        ";
                        exit;
                      }
                    }

                    if($bio1 != ""){
                      $sql = "UPDATE users SET bio = '$bio1' WHERE id = $id1";
                      $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");
                    }

                  echo"
                    <script type=\"text/javascript\">
                      alert(\"Profile Updated!\");
                      location.href = 'editprofile.php';
                    </script>
                  ";
                  }

                ?>

              </div>
              <br/>

            </div>
            
          </div>

        </div>

        <div class="tab-pane container fade" id="changepassword">

          <div class="row vertical-align">
        
            <div class="col-md-6">

              <br/><br/>
              <img class="d-block w-100 shadow" src="img/17.jpg">
              <br/><br/>

            </div>

            <div class="col-md-6">

              <div class="jumbotron shadow">

                <form name="changepasswordform" method="post" onsubmit="return passwordvalidation()">
                  
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <div class="form-group">
                    <label for="password">Current Password</label>
                    <center>
                      <input type="password" name="password" id="password" class="form-control form-control-sm" style="width: 400px; text-transform: lowercase;">
                      <input type="hidden" name="password1" id="password1" value="<?php echo $password; ?>" style="text-transform: lowercase;">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <center>
                      <input type="password" name="newpassword" id="newpassword" class="form-control form-control-sm" style="width: 400px; text-transform: lowercase;">
                    </center>
                  </div>
                  <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <center>
                      <input type="password" name="confirmpassword" id="confirmpassword" class="form-control form-control-sm" style="width: 400px; text-transform: lowercase;">
                    </center>
                  </div>
                  <center>
                    <input type="submit" name="changepass" id="changepass" value="Change Password" class="btn btn-primary btn-md">
                  </center>

                </form>

                <?php

                  if(isset($_POST['changepass'])){

                    include("database.php");

                    // Getting values from form fields
                    $password = $_POST['newpassword'];
                    $password = strtolower($password);
                    $id = $_POST['id'];

                    $sql = "UPDATE users SET password = '$password' WHERE id = $id";
                    $rs = mysqli_query($con, $sql)or die("Could Not Perform the Query");

                    echo "
                      <script type=\"text/javascript\">
                        alert(\"Password Changed!\");
                        location.href = 'editprofile.php';
                      </script>
                    ";

                  }

                ?>

              </div>

            </div>
            
          </div>

        </div>

        <div class="tab-pane container fade" id="changeprofilepicture">

          <div class="row vertical-align">

            <div class="col-md-8">

              <center>
                <br/><br/>
                
                <?php

                  if($image == ""){
                    echo "<img src='img/16.jpg' class='imagefit shadow' src='#'' id='blah' alt='...Your Profile Pic...'>";
                  }else{
                    echo "<img src='$image' class='imagefit shadow' src='#'' id='blah' alt='...Your Profile Pic...'>";
                  }

                ?>

                <br/><br/>
              </center>

            </div>

            <div class="col-md-4">

              <br/><br/>
              <div class="jumbotron shadow">

                <center>
                
                  <form name="changepicform" method="post" enctype="multipart/form-data" onsubmit="return fileCheck()">
                    Select image to upload :
                    <br/>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div>
                      <input type="file" name="uploadedfile" id="uploadedfile" accept="image/*" onchange="readURL(this);">
                    </div>
                    <br/>
                    <div>
                      <input type="submit" name="upload" id="upload" value="Change Profile" class="btn btn-primary btn-md">
                    </div>

                  </form>

                </center>

                <?php

                  if(isset($_POST['upload'])){
                    
                    $id = $_POST['id'];

                    // Compressing Image
                    function compress_image($source_url, $destination_url, $quality) {

                      $info = getimagesize($source_url);

                      if ($info['mime'] == 'image/jpeg')
                        $image = imagecreatefromjpeg($source_url);

                      elseif ($info['mime'] == 'image/gif')
                        $image = imagecreatefromgif($source_url);

                      elseif ($info['mime'] == 'image/png')
                        $image = imagecreatefrompng($source_url);

                      imagejpeg($image, $destination_url, $quality);
                        return $destination_url;
                    }

                    $newfilename = "images/profile/" . $id . ".jpg";
                    if(compress_image($_FILES['uploadedfile']['tmp_name'],$newfilename,50)){
                      include('database.php');
                      $sql = "UPDATE users SET image='$newfilename' WHERE id=$id";
                      if($con->query($sql)==TRUE){
                        echo "
                          <script type=\"text/javascript\">
                            alert(\"Profile Picture Changed!\");
                            location.href = 'editprofile.php';
                          </script>
                        ";
                      }else{
                        echo "Error : ".$sql.$con->error;
                      }
                    }else{
                      echo "
                        <script type=\"text/javascript\">
                          alert(\"File too big! Max size should be 2MB.\");
                          location.href = 'editprofile.php';
                        </script>
                      ";
                    }
                    
                  }

                ?>

              </div>

            </div>

          </div>

        </div>

        <div class="tab-pane container fade" id="deleteaccount">
          
          <div class="row vertical-align">
            
            <div class="col-md-6">

              <br/><br/>
              <img class="d-block w-100 shadow" src="img/18.jpg">
              <br/><br/>

            </div>

            <div class="col-md-6">

              <div class="jumbotron shadow">

                <form name="deleteaccountform" method="post" onsubmit="return accountdelete()">
                    
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <center>
                    <p>If you delete your account all of your posts, likes and comments will be deleted too!</p>
                  </center>
                  <br/>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <center>
                      <input type="password" name="password2" id="password2" class="form-control form-control-sm" style="width: 400px;">
                      <input type="hidden" name="password3" id="password3" value="<?php echo $password; ?>">
                    </center>
                  </div>
                  <center>
                    <input type="submit" name="delete" id="delete" value="Delete Account" class="btn btn-primary btn-md">
                  </center>
                  <br/>

                </form>

                <?php

                  if(isset($_POST['delete'])){
                    
                    $id = $_POST['id'];

                    // Deleting user's profile pic from folder
                    $sql10 = "SELECT * FROM users WHERE id=$id";
                    $result1 = $con->query($sql10);
                    while($row = $result1->fetch_assoc()){
                    	$profilePic = $row['image'];
                    	if($profilePic != ''){
                    		unlink($profilePic);
                    	}
                    }

                    // Deleting pics from user's folder
                    $sql = "SELECT * FROM posts WHERE uid=$id";
                    $result1 = $con->query($sql);
                    if ($result1->num_rows > 0) {
                      while($row = $result1->fetch_assoc()) {
                        $imageLocation = $row['image'];
                        $imageID = $row['id'];
                        unlink($imageLocation);

                        // Deleting all the comments from the user's pics
                        $sql2 = "DELETE FROM comments WHERE imageID=$imageID";
                        $con->query($sql2);

                        // Deleting all the likes from the user's pics
                        $sql9 = "DELETE FROM likes WHERE imageID=$imageID";
                        $con->query($sql9);
                      }
                    }

                    // Deleting user's entire folder
                    rmdir("images/posts/".$id);

                    // Deleting user from db
                    $sql3 = "DELETE FROM users WHERE id=$id";

                    // Deleting user pics from db
                    $sql4 = "DELETE FROM posts WHERE uid=$id";

                    // Deleting user comments from db
                    $sql5 = "DELETE FROM comments WHERE commenterID=$id";

                    // Deleting user likes from db
                    $sql6 = "DELETE FROM likes WHERE likerID=$id";

                    // Deleting user notifications from db
                    $sql7 = "DELETE FROM notifications WHERE uid=$id OR likerID=$id OR commenterID=$id OR followerID=$id";

                    // Deleting user followers from db
                    $sql8 = "DELETE FROM followers WHERE uid=$id OR followerID=$id";
                    

                    if($con->query($sql) ==TRUE && $con->query($sql3) ==TRUE && $con->query($sql4) ==TRUE && $con->query($sql5) ==TRUE && $con->query($sql6) ==TRUE && $con->query($sql7) ==TRUE && $con->query($sql8) ==TRUE){
                      echo "
                        <script type=\"text/javascript\">
                          alert(\"Account Deleted Successfully!\");
                          location.href='index.php';
                          exit();
                        </script>
                      ";
                      
                    }else{
                      echo "Error : ".$sql.$con->error;
                    }
                    
                  }

                ?>

              </div>

            </div>

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