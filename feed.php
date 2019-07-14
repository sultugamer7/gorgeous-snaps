<html>

  <head>

    <!-- Title -->
    <title>Feed | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/feed.css">

    <!-- Javascript for validation -->
    <script src="validations/feed.js"></script>

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
      include("header.php");
      include("getdata.php");
    ?>

    <div class="top"></div>

    <div class="container">
    	<div class="row">
    		<div class="col-md-8" id='feed1'>
    		</div>
        
    		<div class="col-md-4">
    			<div class="jumbotron jumbotronstyle">
	    			<center>
	    				<?php

			              if($image == ""){
			                echo "<img src='img/16.jpg' class='imagefit shadow'>";
			              }else{
			                echo "<img src='$image' class='imagefit shadow'>";
			              }

			            ?>
			            <h6 style="padding-top: 10px; font-size: 1.2rem;">
			            	<a href="profile.php?id=<?php echo $id; ?>" style="color: black;"><?php echo $username; ?></a>
			            </h6>
                  <label style="margin-top: -5px;">
  			            <?php echo $firstname . " " . $lastname; ?>
                  </label>
			            <hr style='margin-top: 3px; margin-bottom: 3px;'>
			            <p>Want to share photos with friends?<br/>Upload them now!</p>
			            <a href="upload.php" class="btn btn-primary btn-sm" style='margin-top: -10px;'>Upload</a>
			            <hr style='margin-top: 10px; margin-bottom: 3px;'>
			            <p>Discover the World's best photos!</p>
			            <a href="explore.php" class="btn btn-primary btn-sm" style='margin-top: -10px;'>Explore</a>
			        </center>
		    	</div>
    		</div>
    	</div>

    	<!-- The Modal with Fade animation -->
    	<div class='modal fade' id='myModal'>
    		<div class='modal-dialog modal-dialog-centered modal-sm'>
    			<div class='modal-content' id='feed2'>
    				
    			</div>
    		</div>
    	</div>
<!-- Getting values to pass to AJAX -->
        <input type="hidden" id="id" value="<?php echo $id; ?>">
    	<!--AJAX-->
    	<script language = "javascript" type = "text/javascript">
    		<!-- 

            // Get the values to pass it to server script.
            var id = document.getElementById('id').value;

            // Displaying posts by AJAX
            function ajaxFeed1() {
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
                			var ajaxDisplay = document.getElementById('feed1');
                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
                		}
                	}

                ajaxRequest.open("GET", "ajax/ajaxFeed1.php?id="+id, true);
                ajaxRequest.send(null); 
            }



            // Liking pic by AJAX
            function ajaxFeed2(imageId1,uid,NoOfLikes) {
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
                			ajaxFeed1();
                		}
                	}

                	ajaxRequest.open("GET", "ajax/ajaxFeed2.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
                }


              	// Uniking pic by AJAX
              	function ajaxFeed3(imageId1,uid,NoOfLikes) {
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
	                    	ajaxFeed1();
	                  	}
	                }

                	ajaxRequest.open("GET", "ajax/ajaxFeed3.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
              	}


              	// Commenting on a pic by AJAX
              	function ajaxFeed4(imageId1,uid,NoOfComments) {
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
	                    	ajaxFeed1();
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


              	// Displaying modal contents by AJAX
              	function ajaxFeed5(uid,imageId1) {
              		var uid = uid;
              		var imageId1 = imageId1;
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
                			var ajaxDisplay = document.getElementById('feed2');
                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
                		}
                	}

                	ajaxRequest.open("GET", "ajax/ajaxFeed5.php?id="+id+"&uid="+uid+"&imageId1="+imageId1, true);
                	ajaxRequest.send(null); 
                }

              // Delete Comment by AJAX
              function ajaxFeed6(commentID,commentData,uid,imageId1) {
              	var commentID1 = commentID;
              	var commentData1 = commentData;
              	var uid = uid;
              	var imageId1 = imageId1;
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
                  	ajaxFeed1();
                    ajaxFeed5(uid,imageId1);
                  }
                }

                ajaxRequest.open("GET", "ajax/ajaxFeed6.php?id="+id+"&uid="+uid+"&imageId1="+imageId1+"&commentID="+commentID1+"&commentData="+commentData1, true);
                ajaxRequest.send(null); 
              }


              // Commenting on a pic through modal by AJAX
              	function ajaxFeed7(imageId1,uid,NoOfComments) {
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
	                    	ajaxFeed1();
	                    	ajaxFeed5(uid,imageId1);
	                  	}
	                }

	                var newComment1 = document.getElementById('newComment1'+imageId1).value;
	                if(newComment1 == ''){
	                	alert('Empty Comment!');
	                }else{
	                	ajaxRequest.open("GET", "ajax/ajaxFeed7.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfComments="+NoOfComments+"&newComment1="+newComment1, true);
	                	ajaxRequest.send(null);
	                	document.getElementById('newComment1'+imageId1).value = '';
	                }
              	}


              	//-->
            </script>
    	
    </div>
    <br/>
    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>

<script>

  $(document).ready(function(){
    ajaxFeed1();

  });
  
</script>