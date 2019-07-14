<?php

      include "../database.php";
      include "../bootstrap.php";

      // Retrieve data from Query String
      $id = $_GET['id'];

      // Escape User Input to help prevent SQL Injection
      $id = mysqli_real_escape_string($con,$id);

      // Marking notifs as read
      $sql = "UPDATE notifications SET notificationStatus=1 WHERE uid=$id AND notificationStatus!=2";
      $con->query($sql);
?>