<?php
  
  if(session_start()){
    session_unset();
    session_destroy();
  }
  
  
?>

<html>

  <head>

    <!-- Title -->
    <title>Home | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/index.css">

  </head>

  <body>

    <!-- Header -->
    <?php
      include("header.php");
    ?>
    
    <!-- Carousel Fade -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">

      <!-- Indicators -->
      <ol class="carousel-indicators" style="margin-bottom: 30px;">

        <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleFade" data-slide-to="1"></li>
        <li data-target="#carouselExampleFade" data-slide-to="2"></li>
        <li data-target="#carouselExampleFade" data-slide-to="3"></li>
        <li data-target="#carouselExampleFade" data-slide-to="4"></li>
      
      </ol>

      <!-- Slideshow with Fade -->
      <div class="carousel-inner">

        <div class="carousel-item active">

          <img class="d-block w-100" src="img/1.jpg?auto=yes&bg=666&fg=444&text=First slide.png">
          <!-- Text on carousel -->
          <div class="carousel-caption">

            <h2 style="font-size:2.3vw;"  class="d-none d-md-block">Get inspired and share your Gorgeous Snaps</h2><br/>
            <p style="font-size:1.3vw;" class="d-none d-lg-block">Join the Gorgeous Snaps community.<br/>Find your home among the world's best photographers.</p><br/>
            <center><button type="button" class="btn btn-light btn-lg d-none d-lg-block"><a href="signup.php" class="btn-color">Sign Up</a></button></center>

          </div>

        </div>

        <div class="carousel-item">

          <img class="d-block w-100" src="img/2.jpg?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
          <!-- Text on carousel -->
          <div class="carousel-caption">

            <h2 style="font-size:2.3vw;"  class="d-none d-md-block">Get inspired and share your Gorgeous Snaps</h2><br/>
            <p style="font-size:1.3vw;" class="d-none d-lg-block">Join the Gorgeous Snaps community.<br/>Find your home among the world's best photographers.</p><br/>
            <center><button type="button" class="btn btn-light btn-lg d-none d-lg-block"><a href="signup.php" class="btn-color">Sign Up</a></button></center>

          </div>

        </div>

        <div class="carousel-item">

          <img class="d-block w-100" src="img/3.jpg?auto=yes&bg=555&fg=333&text=Third slide" alt="Third slide">
          <!-- Text on carousel -->
          <div class="carousel-caption">

            <h2 style="font-size:2.3vw;"  class="d-none d-md-block">Get inspired and share your Gorgeous Snaps</h2><br/>
            <p style="font-size:1.3vw;" class="d-none d-lg-block">Join the Gorgeous Snaps community.<br/>Find your home among the world's best photographers.</p><br/>
            <center><button type="button" class="btn btn-light btn-lg d-none d-lg-block"><a href="signup.php" class="btn-color">Sign Up</a></button></center>

          </div>

        </div>

        <div class="carousel-item">

          <img class="d-block w-100" src="img/4.jpg?auto=yes&bg=555&fg=333&text=Fourth slide" alt="Fourth slide">
          <!-- Text on carousel -->
          <div class="carousel-caption">

            <h2 style="font-size:2.3vw;"  class="d-none d-md-block">Get inspired and share your Gorgeous Snaps</h2><br/>
            <p style="font-size:1.3vw;" class="d-none d-lg-block">Join the Gorgeous Snaps community.<br/>Find your home among the world's best photographers.</p><br/>
            <center><button type="button" class="btn btn-light btn-lg d-none d-lg-block"><a href="signup.php" class="btn-color">Sign Up</a></button></center>

          </div>

        </div>

        <div class="carousel-item">

          <img class="d-block w-100" src="img/5.jpg?auto=yes&bg=555&fg=333&text=Fifth slide" alt="Fifth slide">
          <!-- Text on carousel -->
          <div class="carousel-caption">

            <h2 style="font-size:2.3vw;"  class="d-none d-md-block">Get inspired and share your Gorgeous Snaps</h2><br/>
            <p style="font-size:1.3vw;" class="d-none d-lg-block">Join the Gorgeous Snaps community.<br/>Find your home among the world's best photographers.</p><br/>
            <center><button type="button" class="btn btn-light btn-lg d-none d-lg-block"><a href="signup.php" class="btn-color">Sign Up</a></button></center>

          </div>

        </div>

      </div>

       <!-- Previous Button on Carousel -->
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">

        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>

      </a>

      <!-- Next Button on Carousel -->
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">

        <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>

      </a>
      
    </div>

    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>

</html>