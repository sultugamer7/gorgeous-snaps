<html>

  <head>

    <!-- Title -->
    <title>Explore | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/explore.css">

  </head>

  <body class="bodycolor">

    <!-- Header -->
    <?php
      include("header.php");
    ?>

    <div class="top"></div>

    <div class="container">

    	<!-- Nav pills -->
	      <ul class="nav nav-pills nav-justified" id="myTab">
	        <li class="nav-item">
	          <a class="nav-link active" data-toggle="tab" href="#mostLiked">Most Liked</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" data-toggle="tab" href="#recents">Recents</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" data-toggle="tab" href="#mostCommented">Most Commented</a>
	        </li>
	      </ul>

	      <hr style="background: white;">
		<!-- Tab panes -->
		<div class="tab-content">
			
			<div class="tab-pane container active" id="mostLiked">
          		<center>
            		<div class="row" id="explore1">
            		</div>
          		</center>
              <br/>
              <br/>
        	</div>

        	<div class="tab-pane container fade" id="recents">
	          	<center>
	            	<div class="row" id="explore2">
	            	</div>
          		</center>
              <br/>
              <br/>
       		</div>

       		<div class="tab-pane container fade" id="mostCommented">
          		<center>
            		<div class="row" id="explore3">
            		</div>
          		</center>
              <br/>
              <br/>
        	</div>
		</div>

	</div>
	<br/>

	<!-- Getting values to pass to AJAX -->
    <input type="hidden" id="id" value="<?php echo $id; ?>">

	<!--AJAX-->
    	<script language = "javascript" type = "text/javascript">
    		<!-- 

            // Get the values to pass it to server script.
            var id = document.getElementById('id').value;

            // Displaying most liked posts by AJAX
            function ajaxExplore1() {
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
                			var ajaxDisplay = document.getElementById('explore1');
                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
                		}
                	}

                ajaxRequest.open("GET", "ajax/ajaxExplore1.php?id="+id, true);
                ajaxRequest.send(null); 
            }

            // Displaying recent posts by AJAX
            function ajaxExplore2() {
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
                			var ajaxDisplay = document.getElementById('explore2');
                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
                		}
                	}

                ajaxRequest.open("GET", "ajax/ajaxExplore2.php?id="+id, true);
                ajaxRequest.send(null); 
            }

            // Displaying most commented posts by AJAX
            function ajaxExplore3() {
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
                			var ajaxDisplay = document.getElementById('explore3');
                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
                		}
                	}

                ajaxRequest.open("GET", "ajax/ajaxExplore3.php?id="+id, true);
                ajaxRequest.send(null); 
            }

            // Liking most liked pic by AJAX
            function ajaxExplore1_2(imageId1,uid,NoOfLikes) {
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
                			ajaxExplore1();
                      ajaxExplore2();
                      ajaxExplore3();
                		}
                	}

                	ajaxRequest.open("GET", "ajax/ajaxFeed2.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
                }

                // Uniking most liked pic by AJAX
              	function ajaxExplore1_3(imageId1,uid,NoOfLikes) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
	                  	}
	                }

                	ajaxRequest.open("GET", "ajax/ajaxFeed3.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
              	}

              	// Commenting on most liked pic by AJAX
              	function ajaxExplore1_4(imageId1,uid,NoOfComments) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
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


              	// Liking recent pic by AJAX
            function ajaxExplore2_2(imageId1,uid,NoOfLikes) {
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
                			ajaxExplore1();
                      ajaxExplore2();
                      ajaxExplore3();
                		}
                	}

                	ajaxRequest.open("GET", "ajax/ajaxFeed2.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
                }

                // Uniking recent pic by AJAX
              	function ajaxExplore2_3(imageId1,uid,NoOfLikes) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
	                  	}
	                }

                	ajaxRequest.open("GET", "ajax/ajaxFeed3.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
              	}

              	// Commenting on recent pic by AJAX
              	function ajaxExplore2_4(imageId1,uid,NoOfComments) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
	                  	}
	                }

	                var newComment = document.getElementById('newCommentt'+imageId1).value;
	                if(newComment == ''){
	                	alert('Empty Comment!');
	                }else{
	                	ajaxRequest.open("GET", "ajax/ajaxFeed4.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfComments="+NoOfComments+"&newComment="+newComment, true);
	                	ajaxRequest.send(null);
	                	document.getElementById('newComment'+imageId1).value = '';
	                }
              	}


              	// Liking most commented pic by AJAX
            function ajaxExplore3_2(imageId1,uid,NoOfLikes) {
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
                			ajaxExplore1();
                      ajaxExplore2();
                      ajaxExplore3();
                		}
                	}

                	ajaxRequest.open("GET", "ajax/ajaxFeed2.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
                }

                // Uniking most commented pic by AJAX
              	function ajaxExplore3_3(imageId1,uid,NoOfLikes) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
	                  	}
	                }

                	ajaxRequest.open("GET", "ajax/ajaxFeed3.php?id="+id+"&imageId1="+imageId1+"&uid="+uid+"&NoOfLikes="+NoOfLikes, true);
                	ajaxRequest.send(null); 
              	}

              	// Commenting on most commented pic by AJAX
              	function ajaxExplore3_4(imageId1,uid,NoOfComments) {
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
	                    	ajaxExplore1();
                        ajaxExplore2();
                        ajaxExplore3();
	                  	}
	                }

	                var newComment = document.getElementById('newCommenttt'+imageId1).value;
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
    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>

<script>

  $(document).ready(function(){

    ajaxExplore1();
    ajaxExplore2();
    ajaxExplore3();

  });
  
</script>