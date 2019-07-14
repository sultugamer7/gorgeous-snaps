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
 ?>

<html>

  <head>

  	<!-- Title -->
    <title>Details | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/details.css">

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

    <div class="jumbotron jumbotronstyle1" id="details1"></div>

    		<!-- Gettig values to pass in AJAX-->
        <input type="hidden" id="id1" value="<?php echo $id1; ?>">
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <input type="hidden" id="id0" value="<?php echo $id0; ?>">

        <!--AJAX-->
        <script language = "javascript" type = "text/javascript">
          <!-- 

              // Get the values to pass it to server script
              var id1 = document.getElementById('id1').value;
              var id = document.getElementById('id').value;
              var id0 = document.getElementById('id0').value;

              // Display Details section by AJAX
              function ajaxDetails1() {
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
                    var ajaxDisplay = document.getElementById('details1');
                    ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxDetails1.php?id="+id+"&id0="+id0+"&id1="+id1, true);
                ajaxRequest.send(null); 
              }

              // Delete Comment by AJAX
              function ajaxDetails2(commentID,commentData) {
              	var commentID1 = commentID;
              	var commentData1 = commentData;
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
                    ajaxDetails1();
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxDetails2.php?id="+id+"&id0="+id0+"&id1="+id1+"&commentID="+commentID1+"&commentData="+commentData1, true);
                ajaxRequest.send(null); 
              }


              // Confirming user wants to delete the post
              function confirmation(){
                var bool = confirm("Are you sure?");
                if(bool == true){
                  ajaxDetails3();
                }else{
                  return false;
                }
              }

              // Delete Image by AJAX
              function ajaxDetails3() {
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
                  	window.location.href = "profile.php?id="+id0;
                  	alert('Post Deleted!')
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxDetails3.php?id1="+id1, true);
                ajaxRequest.send(null); 
              }

              // Update Caption by AJAX
              function ajaxDetails4() {
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
                  	ajaxDetails1();
                  	alert('Caption Updated!');
                  }
                }

                // Getting new caption
                var newCaption = document.getElementById('newCaption').value;

                // Adding line break
                newCaption = newCaption.replace(/\n/g,'<br>');

                ajaxRequest.open("GET", "ajax/ajaxDetails4.php?id1="+id1+"&newCaption="+newCaption, true);
                ajaxRequest.send(null); 
              }


              // Liking and unliking pic by AJAX
              function ajaxDetails5() {
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
                  	ajaxDetails1();
                  }
                }

                // Getting value of button clicked
                var buttonClicked = document.getElementById('LikeUnlike').value;

                ajaxRequest.open("GET", "ajax/ajaxDetails5.php?id="+id+"&id1="+id1+"&buttonClicked="+buttonClicked, true);
                ajaxRequest.send(null); 
              }


            // Adding comments by AJAX
            function ajaxDetails6() {
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
                  	ajaxDetails1();
                  }
                }

                var newComment = document.getElementById('newComment').value;
                if(newComment == ''){
                	alert('Empty Comment!');
                }else{
                  // Adding line break
                  newComment = newComment.replace(/\n/g,'<br>');

                	ajaxRequest.open("GET", "ajax/ajaxDetails6.php?id="+id+"&id1="+id1+"&newComment="+newComment, true);
                	ajaxRequest.send(null);
                	document.getElementById('newComment').value = '';
                }
              }
              //-->
            </script>
      <br/>

  </body>

</html>

<script>

  $(document).ready(function(){

    ajaxDetails1();

  });
  
</script>