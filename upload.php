<html>

  <head>

    <!-- Title -->
    <title>Feed | Gorgeous Snaps</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles/upload.css">

    <!-- Javascript for validation -->
    <script src="validations/upload.js"></script>

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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          
          <div class="jumbotron">
            
            <form name="uploadpics" method="post" enctype="multipart/form-data" onsubmit="return fileCheck()">
              <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <center>
                <input type="file" name="uploadedfile" id="uploadedfile" accept="image/*" onchange="readURL(this);">
              </center>
              <div class="row">
                <div class="col-md-6">
                  <br/>
                  <img class="d-block w-100" src="#" id="blah" alt="...Your Image...">
                </div>
                <div class="col-md-6">
                  <br/>
                  <div class="form-group">
                    <textarea rows="7" cols="50" name="caption" id="caption" placeholder="Write caption here..." maxlength="150" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <br/>
              <center>
                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-primary">
              </center>
            </form>
            <?php

              if(isset($_POST['upload'])){
                        
                $uid = $_POST['id'];
                $sql = "SELECT * FROM posts ORDER BY id ASC";
                $result = $con->query($sql);
                $id = "";

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $id = $row['id'] + 1;
                  }
                }else{
                  $id = 0;
                }

                // Compressing Image
                function compress_image($source_url, $destination_url, $quality) {

                  $info = getimagesize($source_url);

                  if ($info['mime'] == 'image/jpeg')
                    $image = imagecreatefromjpeg($source_url);

                  elseif ($info['mime'] == 'image/gif')
                    $image = imagecreatefromgif($source_url);

                  elseif ($info['mime'] == 'image/png')
                    $image = imagecreatefrompng($source_url);

                  imagejpeg($image, $destination_url, $quality);
                    return $destination_url;
                }

                $newfilename = "images/posts/" . $uid . "/" . $id . ".jpg";
                $caption = $_POST['caption'];
                if(compress_image($_FILES['uploadedfile']['tmp_name'],$newfilename,70)){
                  include('database.php');
                  $sql1 = "INSERT INTO posts(uid,image,caption) VALUES('$uid','$newfilename',\"$caption\")";
                  if($con->query($sql1) == TRUE){
                    echo "
                      <script type=\"text/javascript\">
                        alert(\"Picture Uploaded!\");
                        location.href = 'feed.php';
                      </script>
                    ";
                  }else{
                    echo "Error : ".$sql.$con->error;
                  }
                }else{
                  echo "
                    <script type=\"text/javascript\">
                      alert(\"File size too big! Max size should be 10MB.\");
                      location.href = 'feed.php';
                    </script>
                  ";
                }
                        
              }

            ?>

          </div>

          

        </div>

        <div class="col-md-2">
        </div>

      </div>

    </div>
    <br/>

    <!-- Footer -->
    <?php
      include("footer.php");
    ?>

  </body>