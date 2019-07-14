<?php
  include("database.php");
  $id1 = $_GET['id1'];
  $id = $_GET['id'];
  $postID = '';
  $sql1 = "SELECT * FROM reports WHERE reporterID=$id AND uid=$id1 AND postID IS NULL";
  $result = $con->query($sql1);
  if($result->num_rows == 0){
    $sql = "INSERT INTO reports(reporterID,uid) VALUES($id,$id1)";
    if($con->query($sql) == TRUE) {
      echo '
        <script>
          alert("User Reported!");
          window.location.href = "feed.php";
        </script>
      ';
    }
  }else{
    echo '
      <script>
        alert("User Already Reported!");
        window.location.href = "feed.php";
      </script>
    ';
  }
  
?>