<html>

  <head>

    <?php
      include("bootstrap.php");
    ?>

    <style type="text/css">
      .btn-color{
        color: black;
      }
      .navbar{
        background: rgba(0, 0, 0, 0.7);
      }
      .btn-link {
        color: white !important;
      }
      .vertical-align {
		display: flex;
		align-items: center;
	  }

      #result{
        position: absolute;
        width: auto; 
        background: white;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        max-height: 225px;
        overflow-y: auto;
        border-style: solid;
    	border-width: 0.4px;
        

        margin-left: 6.1;
        width: 390.2px;
        top: 51.8px;
      }

      .btn{
      	background: rgba(250, 190, 220, 0.0);
      }
      .btn:hover {
		  background: rgba(250, 190, 220, 0.25);
		}

    </style>
    

    <script type="text/javascript">
      
      function logoutConfirmation(){

        var bool = confirm("Are you sure?");
        if(bool == false){
          return false;
        }else{
          return true;
        }
      }

    </script>

  </head>

  <body>

    <form method="post">

      <!-- Fixed Transparent Navigation Bar -->
      <nav class="navbar navbar-expand navbar-dark fixed-top transparent">
        
        <?php
          session_start();
          if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            include("getdata.php");
            echo '
              <a href="feed.php" class="navbar-brand text-light font-weight-bold" style="padding-left: 25px;"><h4><b>Gorgeous Snaps</b></h4></a>

              <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-logo ml-auto">
                  <li class="nav-item">
                    <input type="text" class="form-control" id="search_text" placeholder="Search username..." style="width: 400; margin-left: 1px;" autocomplete="off">
                    <div id="result"></div>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto" style="padding-right: 25px;">
                	<li class="navbar-item" id="header2">
            ';

            
            echo '
            	  </li>
                  <li class="navbar-item">
                    <a href="profile.php?id='.$id.'" class="btn btn-outline-dark" title="Profile" style="margin-left: 11px;">👱</a>
                  </li>
                  <li class="navbar-item" style="padding-left: 13px;">
                      <input type="submit" name="logout" class="btn btn-light" title="Log Out" value="🚪" onclick="return logoutConfirmation();">
                  </li>

                </ul>
                    
              </div>
              <!-- Getting values to pass to AJAX -->
        	  <input type="hidden" id="id" value="'.$id.'">
            ';
            if(isset($_POST['logout'])){
              session_unset();
              session_destroy();
              header("location:index.php");
              exit();
            }
            ?>
            <!-- AJAX -->
            <script language = "javascript" type = "text/javascript">
	    		<!-- 

	            // Get the values to pass it to server script.
	            var id = document.getElementById('id').value;
	            
	            // Displaying notifications by AJAX
	            function ajaxHeader2() {
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
	                			var ajaxDisplay = document.getElementById('header2');
	                			ajaxDisplay.innerHTML = ajaxRequest.responseText;
	                			ajaxHeader4();
	                			ajaxHeader7();
	                		}
	                	}

	                ajaxRequest.open("GET", "ajax/ajaxHeader2.php?id="+id, true);
	                ajaxRequest.send(null); 
	            }

	            // Marking notifications as read by AJAX
	            function ajaxHeader3() {
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
	                			ajaxHeader2();
	                		}
	                	}

	                ajaxRequest.open("GET", "ajax/ajaxHeader3.php?id="+id, true);
	                ajaxRequest.send(null); 
	            }
	            // -->
	        </script>

            <?php
            

          }else{
              
            echo '
              <a href="index.php" class="navbar-brand text-light font-weight-bold" style="padding-left: 25px;"><h4><b>Gorgeous Snaps</b></h4></a>
              <div class="collapse navbar-collapse text-center">
          
                <ul class="navbar-nav ml-auto" style="padding-right: 25px;">

                  <li class="navbar-item">
                    <a href="login.php" class="btn btn-link">Log In</a>
                  </li>
                  <li class="navbar-item">
                    <a href="signup.php" class="btn btn-light">Sign Up</a>
                  </li>

                </ul>

              </div>
            ';
          }
            
        ?>
      
      </nav>

      <!-- Notification Modal -->
      <?php
      	if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
      ?>
      
      <div id="notificationModal" class="modal" role="document">

      	<div class="modal-dialog">

      		<!-- Modal content-->
      		<div class="modal-content">

      			<div class="modal-header">

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px;">
			        	<span aria-hidden="true">&times;</span>
			        </button>

			    </div>

      			<div class="modal-body" id="header3"></div>

      		</div>

      	</div>

      </div>

      <div id="messageModal" class="modal" role="document">

      	<div class="modal-dialog">

      		<!-- Modal content-->
      		<div class="modal-content">

      			<div class="modal-header">

			        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px;">
			        	<span aria-hidden="true">&times;</span>
			        </button>

			    </div>

      			<div class="modal-body" id="header4"></div>

      		</div>

      	</div>

      </div>

      <!-- AJAX -->
    <script language = "javascript" type = "text/javascript">
		<!-- 

        // Get the values to pass it to server script.
        var id = document.getElementById('id').value;
        
        // Displaying notifications by AJAX
        function ajaxHeader4() {
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
            			var ajaxDisplay = document.getElementById('header3');
            			ajaxDisplay.innerHTML = ajaxRequest.responseText;
            		}
            	}

            ajaxRequest.open("GET", "ajax/ajaxHeader4.php?id="+id, true);
            ajaxRequest.send(null); 
        }

        // Follow notifications onclick
        function ajaxHeader5(followerID) {
        	var followerID = followerID;
            window.location.href = "profile.php?id="+followerID;
        }
        // Like & comment notifications onclick
        function ajaxHeader6(postID) {
        	var postID = postID;
            window.location.href = "details.php?id="+postID+"&id0="+id;
        }

        // Displaying message notification by AJAX
        function ajaxHeader7() {
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
            			var ajaxDisplay = document.getElementById('header4');
            			ajaxDisplay.innerHTML = ajaxRequest.responseText;
            		}
            	}

            ajaxRequest.open("GET", "ajax/ajaxHeader5.php?id="+id, true);
            ajaxRequest.send(null); 
        }
        // -->
    </script>

      <?php
      	}
      ?>
      
    </form>


  </body>

</html>

<script>
	$(document).ready(function(){

		load_data();
		ajaxHeader2();
		setInterval(function(){ajaxHeader2();},1500);
		

		function load_data(query){
			$.ajax({
				url:"ajax/ajaxHeader1.php",
				method:"POST",
				data:{query:query},
				success:function(data){
					$('#result').html(data);
				}
			});
		}
		$('#search_text').keyup(function(){
			var search = $(this).val();
			if(search != ''){
				load_data(search);
			}else{
				load_data();
			}
		});

	});
</script>