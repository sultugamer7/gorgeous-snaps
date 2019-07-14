<?php

  include("database.php");

  // Getting username from the session
  $id = $_SESSION['id'];

  // Select query to get all the data
  $sql = "SELECT * FROM admin WHERE id = $id";
  $result = $con->query($sql);
  $username = "";
  $password = "";
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $username = $row['username'];
    	$password = $row['password'];
    }
} else {
    echo "0 results";
}

?>