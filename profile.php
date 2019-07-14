<?php
  include("database.php");
  $id1 = $_GET['id'];
  $sql1 = "SELECT * FROM users WHERE id = $id1";
  $result1 = $con->query($sql1);
  $firstname1 = "";
  $lastname1 = "";
  $username1 = "";
  $bio1 = "";
  $image1 = "";
  if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
      $firstname1 = $row["firstname"];
      $lastname1 = $row['lastname'];
      $username1 = $row['username'];
      $bio1 = $row['bio'];
      $image1 = $row['image'];
    }
  }

?>
<html>

  <head>

    <!-- Title -->
    <title><?php echo $username1; ?> | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/profile.css">

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
      include("header.php");
    ?>

    <div class="top">

    </div>

    <div class="container">
      
      <div class="row">
        
        <div class="col-md-4">
          
          <center>

            <?php

              if($image1 == ""){
                echo "<img src='img/16.jpg' class='imagefit shadow'>";
              }else{
                echo "<img src='$image1' class='imagefit shadow'>";
              }

            ?>

          </center>
          
        </div>

        <div class="col-md-8 shadow" style="margin-top: 7px; border-style: solid; border-width: 1px; border-color: lightgray; border-radius: 2px;">

            <h4 style="font-weight: normal; margin-top: 2px;">
                <?php echo $username1 ?>
            </h4>
            <?php
              if($username != $username1){
                echo '
                  <form name="message" action="message.php" method="post">
                    <input type="hidden" name="id" id="id" value='.$id.'>
                    <input type="hidden" name="id1" id="id1" value='.$id1.'>
                    <input type="submit" id="msg" name="msg" class="btn btn-sm btn-outline-warning shadow" style="position: absolute; margin-top: 8px; margin-left: 100px;" value="Message">
                  </form>
                ';

              }
            ?>
            
            

            <!-- Gettig values to pass in AJAX-->
            <input type="hidden" id="username" value="<?php echo $username; ?>">
            <input type="hidden" id="username1" value="<?php echo $username1; ?>">
            <input type="hidden" id="id" value="<?php echo $id; ?>">
            <input type="hidden" id="id1" value="<?php echo $id1; ?>">

            <!-- Div to get the server side script through AJAX -->
            <div id="profile1"></div>

            

        </div>

      </div>

    </div>

    <hr style="margin-bottom: 26px;">

    <div class="container" id="profile2">
    </div>

    <br/>

    <!--AJAX-->
            <script language = "javascript" type = "text/javascript">
              <!-- 

              // Get the values to pass it to server script.
              var username = document.getElementById('username').value;
              var username1 = document.getElementById('username1').value;
              var id = document.getElementById('id').value;
              var id1 = document.getElementById('id1').value;

              //Browser Support Code
              function ajaxProfile1() {
                var ajaxRequest;  // The variable that makes Ajax possible!
                  
                try {        
                  // Opera 8.0+, Firefox, Safari
                  ajaxRequest = new XMLHttpRequest();
                } catch (e) {

                  // Internet Explorer Browsers
                  try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  } catch (e) {

                    try {
                      ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                      // Something went wrong
                      alert("Your browser broke!");
                      return false;
                    }
                  }
                }

                // Create a function that will receive data
                // sent from the server and will update
                // div section in the same page.
                ajaxRequest.onreadystatechange = function() {

                  if(ajaxRequest.readyState == 4) {
                    var ajaxDisplay = document.getElementById('profile1');
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxProfile1.php?username="+username+"&username1="+username1+"&id="+id+"&id1="+id1, true);
                ajaxRequest.send(null); 
              }

              // Confirming user wants to unfollow
              function confirmation(){
                var bool = confirm("Are you sure?");
                if(bool == true){
                  ajaxProfile2();
                }else{
                	return false;
                }
              }

              //Browser Support Code
              function ajaxProfile2() {
                var ajaxRequest;  // The variable that makes Ajax possible!
                  
                try {        
                  // Opera 8.0+, Firefox, Safari
                  ajaxRequest = new XMLHttpRequest();
                } catch (e) {

                  // Internet Explorer Browsers
                  try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  } catch (e) {

                    try {
                      ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                      // Something went wrong
                      alert("Your browser broke!");
                      return false;
                    }
                  }
                }



                // Create a function that will receive data
                // sent from the server and will update
                // div section in the same page.
                ajaxRequest.onreadystatechange = function() {

                  if(ajaxRequest.readyState == 4) {
                    ajaxProfile1();
                  }
                }

                // Getting value of button clicked
                var buttonClicked = document.getElementById('FollowUnfollow').value;

                ajaxRequest.open("GET", "ajax/ajaxProfile2.php?id="+id+"&id1="+id1+"&buttonClicked="+buttonClicked, true);
                ajaxRequest.send(null); 
              }

              //Browser Support Code
              function ajaxProfile3() {
                var ajaxRequest;  // The variable that makes Ajax possible!
                  
                try {        
                  // Opera 8.0+, Firefox, Safari
                  ajaxRequest = new XMLHttpRequest();
                } catch (e) {

                  // Internet Explorer Browsers
                  try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  } catch (e) {

                    try {
                      ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                      // Something went wrong
                      alert("Your browser broke!");
                      return false;
                    }
                  }
                }

                // Create a function that will receive data
                // sent from the server and will update
                // div section in the same page.
                ajaxRequest.onreadystatechange = function() {

                  if(ajaxRequest.readyState == 4) {
                    var ajaxDisplay = document.getElementById('profile2');
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxProfile3.php?username="+username+"&username1="+username1+"&id="+id+"&id1="+id1, true);
                ajaxRequest.send(null); 
              }

              // Liking most commented pic by AJAX
            function ajaxProfile3_2(imageId1,uid,NoOfLikes) {
              var imageId1 = imageId1;
              var uid = uid;
              var NoOfLikes = NoOfLikes;
                  var ajaxRequest;  // The variable that makes Ajax possible!

                  try {        
                      // Opera 8.0+, Firefox, Safari
                      ajaxRequest = new XMLHttpRequest();
                    } catch (e) {

                      // Internet Explorer Browsers
                      try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                      } catch (e) {

                        try {
                          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                          }
                        }
                      }

                  // Create a function that will receive data
                  // sent from the server and will update
                  // div section in the same page.
                  ajaxRequest.onreadystatechange = function() {

                    if(ajaxRequest.readyState == 4) {
                      ajaxProfile3();
                    }
                  }

                  ajaxRequest.open("GET", "ajax/ajaxFeed2.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                  ajaxRequest.send(null); 
                }

                // Uniking most commented pic by AJAX
                function ajaxProfile3_3(imageId1,uid,NoOfLikes) {
                  var imageId1 = imageId1;
                  var uid = uid;
                  var NoOfLikes = NoOfLikes;
                  var ajaxRequest;  // The variable that makes Ajax possible!
                  
                  try {        
                      // Opera 8.0+, Firefox, Safari
                      ajaxRequest = new XMLHttpRequest();
                  } catch (e) {

                      // Internet Explorer Browsers
                      try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                      } catch (e) {

                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                      }
                  }

                  // Create a function that will receive data
                  // sent from the server and will update
                  // div section in the same page.
                  ajaxRequest.onreadystatechange = function() {

                      if(ajaxRequest.readyState == 4) {
                        ajaxProfile3();
                      }
                  }

                  ajaxRequest.open("GET", "ajax/ajaxFeed3.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                  ajaxRequest.send(null); 
                }

                // Commenting on most liked pic by AJAX
                function ajaxProfile3_4(imageId1,uid,NoOfComments) {
                  var imageId1 = imageId1;
                  var uid = uid;
                  var NoOfComments = NoOfComments;
                  var ajaxRequest;  // The variable that makes Ajax possible!
                  
                  try {        
                      // Opera 8.0+, Firefox, Safari
                      ajaxRequest = new XMLHttpRequest();
                  } catch (e) {

                      // Internet Explorer Browsers
                      try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                      } catch (e) {

                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                      }
                  }

                  // Create a function that will receive data
                  // sent from the server and will update
                  // div section in the same page.
                  ajaxRequest.onreadystatechange = function() {

                      if(ajaxRequest.readyState == 4) {
                        ajaxProfile3();
                      }
                  }

                  var newComment = document.getElementById('newComment'+imageId1).value;
                  if(newComment == ''){
                    alert('Empty Comment!');
                  }else{
                    ajaxRequest.open("GET", "ajax/ajaxFeed4.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfComments="+NoOfComments+"&newComment="+newComment, true);
                    ajaxRequest.send(null);
                    document.getElementById('newComment'+imageId1).value = '';
                  }
                }


              //-->
            </script>
            <br/><br/>

    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>

<script>

  $(document).ready(function(){

    ajaxProfile1();
    ajaxProfile3();

  });
  
</script>