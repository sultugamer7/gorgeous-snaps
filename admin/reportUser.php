<?php
  include("database.php");
  $reporterID = $_GET['reporterID'];
  $uid1 = $_GET['uid'];

  // Getting reported user's data
  $profilepic90 = "../";
  $username90 = "";
  $sql2 = "SELECT * FROM users WHERE id=$uid1";
  $result2 = $con->query($sql2);
  $repID2 = '';
  while($row = $result2->fetch_assoc()){
   $profilepic90 .= $row['image'];
   $username90 = $row['username'];
   $repID2 = $row['id'];
  }
  if($profilepic90 == '../'){
    $profilepic90 = 'img/16.jpg';
  }

  // Getting reporter's data
  $profilepic80 = "../";
  $username80 = "";
  $repID = '';
  $sql2 = "SELECT * FROM users WHERE id=$reporterID";
  $result2 = $con->query($sql2);
  while($row = $result2->fetch_assoc()){
   $profilepic80 .= $row['image'];
   $username80 = $row['username'];
   $repID = $row['id'];
  }
  if($profilepic80 == '../'){
    $profilepic80 = 'img/16.jpg';
  }

?>

<html>

  <head>

    <!-- Title -->
    <title>Report Post | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/reportUser.css">

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
    include("header.php");
    $datetime = date("d-m-Y", strtotime($datetime));
    ?>

    <div class="top">

    </div>

    <div class="container">
      <div class="row vertical-align">
        <div class="col-lg-3">
        </div> 
        <div class="col-lg-6">
          <div class="jumbotron jumbotronstyle1">
            <form method="post">
              <center>
                <div class="row">
                  <label style="margin-left: 30px;">Reported Profile : 
                    <a href="profile.php?id=<?php echo $repID2; ?>"><?php echo $username90; ?></a>
                  </label>
                </div>
                <div class="row">
                  <label style="margin-left: 30px;">Reported By : 
                    <a href="profile.php?id=<?php echo $repID; ?>"><?php echo $username80; ?></a> 
                  </label>
                </div>
                <input type="submit" class="btn btn-primary btn-lg" name="keep" id="keep" value="Keep" style="width: 150px;">
                <br/><br/>
                <input type="submit" class="btn btn-danger btn-lg" name="delete" id="delete" value="Delete" style="width: 150px;">
              </center>
            </form>
            <?php
              // Keep
              if(isset($_POST['keep'])) {
                $sql = "UPDATE reports SET status=1 WHERE reporterID=$repID AND uid=$repID2 AND postID IS NULL";
                if($con->query($sql) == TRUE){
                  echo '
                    <script>
                      alert("Resolved!");
                      window.location.href="dashboard.php";
                    </script>
                  ';
                }
              }

              // Delete
              if(isset($_POST['delete'])) {
                $sql1 = "UPDATE reports SET status=1, decision=1 WHERE reporterID=$repID AND uid=$repID2 AND postID IS NULL";
                

                // Deleting user's profile pic from folder
                $sql10 = "SELECT * FROM users WHERE id=$repID2";
                $result1 = $con->query($sql10);
                while($row = $result1->fetch_assoc()){
                  $profilePic = '../'.$row['image'];
                  if($profilePic != '../'){
                    unlink($profilePic);
                  }
                }

                // Deleting pics from user's folder
                $sql = "SELECT * FROM posts WHERE uid=$repID2";
                $result1 = $con->query($sql);
                if ($result1->num_rows > 0) {
                  while($row = $result1->fetch_assoc()) {
                    $imageLocation = '../'.$row['image'];
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
                rmdir("../images/posts/".$repID2);

                // Deleting user from db
                $sql3 = "DELETE FROM users WHERE id=$repID2";
               

                // Deleting user pics from db
                $sql4 = "DELETE FROM posts WHERE uid=$repID2";

                // Deleting user comments from db
                $sql5 = "DELETE FROM comments WHERE commenterID=$repID2";

                // Deleting user likes from db
                $sql6 = "DELETE FROM likes WHERE likerID=$repID2";

                // Deleting user notifications from db
                $sql7 = "DELETE FROM notifications WHERE uid=$repID2 OR likerID=$repID2 OR commenterID=$repID2 OR followerID=$repID2";

                // Deleting user followers from db
                $sql8 = "DELETE FROM followers WHERE uid=$repID2 OR followerID=$repID2";

                if($con->query($sql1) == TRUE && $con->query($sql) == TRUE &&  $con->query($sql3) == TRUE && $con->query($sql4) == TRUE && $con->query($sql5) == TRUE && $con->query($sql6) == TRUE && $con->query($sql7) == TRUE && $con->query($sql8) == TRUE){
                  echo '
                    <script>
                      alert("Resolved!");
                      window.location.href="dashboard.php";
                    </script>
                  ';
                }
              }
            ?>
          </div>
        </div>
        <div class="col-lg-3">
        </div> 
      </div>
    </div>

    <br/>

  </body>

</html>