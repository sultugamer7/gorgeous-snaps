<?php
  include("database.php");
  $id1 = $_GET['id'];
  $id0 = $_GET['id0'];
  $sql1 = "SELECT * FROM posts WHERE id = $id1";
  $result1 = $con->query($sql1);
  $uid = "";
  $image1 = "";
  $caption = "";
  $datetime = "";
  $NoOfLikes = "";
  $NoOfComments = "";
  if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
      $uid = $row["uid"];
      $image1 = $row['image'];
      $caption = $row['caption'];
      $datetime = $row['datetime'];
      $NoOfLikes = $row['likes'];
      $NoOfComments = $row['comments'];
    }
  }

  $profilepic90 = "";
  $username90 = "";
  $sql2 = "SELECT * FROM users WHERE id=$id0";
  $result2 = $con->query($sql2);
  while($row = $result2->fetch_assoc()){
   $profilepic90 = $row['image'];
   $username90 = $row['username'];
  }
  if($profilepic90 == ''){
    $profilepic90 = 'img/16.jpg';
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
    include("getdata.php");
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
              <!-- Profile pic -->
              <div class="col-lg-1">
                <img src="<?php echo $profilepic90; ?>" style="height: 60px; width: 62px; object-fit: cover; margin-left: 11px;" class="shadow rounded-circle">
              </div>
              <!-- Username -->
              <div class="col-lg-1"></div>
              <div class="col-lg-10" style="margin-top: 14px; font-size: 18px;">
                <a href="profile.php?id=<?php echo $id0; ?>"><?php echo $username90; ?></a>
              </div>
            </div>
            <hr style="margin-bottom: 0px;">
            <!-- Displaying Post -->
            <div class="row">

              <div class="col-lg-12" style="font-size: 18px;">
                <label style="font-size: 11px; margin-bottom: -11px; margin-left: 5px; color: red; position: absolute; background: rgba(255,255,255,0.7);">Date Posted : <?php echo $datetime; ?></label>
                <center>
                  <img src="<?php echo $image1; ?>" style="max-height: 410px; max-width: 380px;">
                </center>
              </div>
            </div>
            <hr style="margin-top: 0px; margin-bottom: 0px;">
          </div>
        </div>
        <div class="col-lg-6">
          <!-- Displaying Textarea -->
          <div class="jumbotron jumbotronstyle1">
            <div class="row" style="margin-top: 50; margin-bottom: -25px;">
              <center>
                <form method="post">
                  <textarea rows="7" cols="50" name="report" id="report" class="form-control form-control-sm" placeholder="Tell us more about this post... (Max : 150 letters)" style="margin-left: 66px; height: 100px;" maxlength="150"></textarea>
                  <br/>
                  <input type="submit" name="submit" id="submit" value="Report" class="btn btn-primary" style="margin-left: 134px;">
                </form>
              </center>
            </div>
            <?php
               if(isset($_POST["submit"])){
                $report = $_POST['report'];
                $sql1 = "SELECT * FROM reports WHERE reporterID=$id AND uid=$id0 AND postID=$id1";
                $result = $con->query($sql1);
                if($result->num_rows == 0){
                  $sql = "INSERT INTO reports(reporterID,reportData,uid,postID) VALUES($id,'$report',$id0,$id1)";
                  if($con->query($sql) == TRUE) {
                    echo '
                      <script>
                        alert("Post Reported!");
                        window.location.href = "reportPost.php?id='.$id1.'&id0='.$id0.'";
                      </script>
                    ';
                  }
                }else{
                  echo '
                    <script>
                      alert("Post Already Reported!");
                      window.location.href = "reportPost.php?id='.$id1.'&id0='.$id0.'";
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
    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>