<?php

      include "../database.php";
      include "../bootstrap.php";

      // Retrieve data from Query String
      $id = $_GET['id'];

      // Escape User Input to help prevent SQL Injection
      $id = mysqli_real_escape_string($con,$id);

      // Marking notifs as read
      $sql = "UPDATE reports SET reportStatus=1";
      $con->query($sql);
?>