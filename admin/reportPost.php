<?php
  include("database.php");
  $reporterID = $_GET['reporterID'];
  $uid1 = $_GET['uid'];
  $postID = $_GET['postID'];
  // Getting post's data
  $sql1 = "SELECT * FROM posts WHERE id = $postID";
  $result1 = $con->query($sql1);
  $postID1 = '';
  $image1 = "../";
  if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
      $postID1 = $row['id'];
      $image1 .= $row['image'];
    }
  }

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

  // Getting report data
  $reportData = '';
  $sql2 = "SELECT * FROM reports WHERE reporterID=$reporterID AND uid=$uid1 AND postID=$postID";
  $result2 = $con->query($sql2);
  while($row = $result2->fetch_assoc()){
    $reportData .= $row['reportData'];
  }

?>

<html>

  <head>

    <!-- Title -->
    <title>Report Post | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/reportPost.css">

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
        <div class="col-lg-6">
          <!-- Displaying Post and user info-->
          <div class="jumbotron jumbotronstyle1">
            <div class="row">
              <label style="margin-left: 30px;">Reported By : 
                <a href="profile.php?id=<?php echo $repID; ?>"><?php echo $username80; ?></a>
              </label>
            </div>
            <div class="row">
              <label style="margin-left: 30px;">Posted By : 
                <a href="profile.php?id=<?php echo $repID2; ?>"><?php echo $username90; ?></a> 
              </label>
            </div>
            <div class="row">
              <label style="margin-left: 30px;">Reason : <?php echo $reportData; ?></label>
            </div>
            <div class="row">
              <img src="<?php echo $image1; ?>" style="max-height: 410px; max-width: 536px; margin-left: 15px; object-fit: contain;">
            </div>
          </div>
        </div> 
        <div class="col-lg-6">
          <div class="jumbotron jumbotronstyle1">
            <form method="post">
              <center>
                <br/><br/>
                <input type="submit" class="btn btn-primary btn-lg" name="keep" id="keep" value="Keep" style="width: 150px;">
                <br/><br/>
                <input type="submit" class="btn btn-danger btn-lg" name="delete" id="delete" value="Delete" style="width: 150px;">
              </center>
            </form>
            <?php
              // Keep
              if(isset($_POST['keep'])) {
                $sql = "UPDATE reports SET status=1 WHERE reporterID=$repID AND uid=$repID2 AND postID=$postID1";
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
                $sql = "UPDATE reports SET status=1, decision=1 WHERE reporterID=$repID AND uid=$repID2 AND postID=$postID1";
                $sql1 = "SELECT * FROM posts WHERE id = $postID1";
                $result1 = $con->query($sql1);
                $image1 = "";
                if ($result1->num_rows > 0) {
                  while($row = $result1->fetch_assoc()) {
                    $image1 = $row['image'];
                  }
                }
                
                // Deleting pic from folder
                unlink('../'.$image1);

                // Deleting pic location, likes, comments and notifications from db
                $sql4 = "DELETE FROM posts WHERE id=".$postID1;

                $sql5 = "DELETE FROM comments WHERE imageID=".$postID1;

                $sql6 = "DELETE FROM likes WHERE imageID=".$postID1;

                $sql7 = "DELETE FROM notifications WHERE postID=".$postID1;

                if($con->query($sql) == TRUE && $con->query($sql4) == TRUE && $con->query($sql5) == TRUE && $con->query($sql6) == TRUE && $con->query($sql7) == TRUE){
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
      </div>
    </div>

    <br/>

  </body>

</html>