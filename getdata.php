<?php

  include("database.php");

  // Getting username from the session
  $id = $_SESSION['id'];

  // Select query to get all the data
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = $con->query($sql);
  $firstname = "";
  $lastname = "";
  $email = "";
  $username = "";
  $password = "";
  $bio = "";
  $image = "";
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$firstname = $row["firstname"];
    	$lastname = $row['lastname'];
    	$email = $row['email'];
      $username = $row['username'];
    	$password = $row['password'];
    	$bio = $row['bio'];
      $image = $row['image'];
    }
} else {
    echo "0 results";
}

?>