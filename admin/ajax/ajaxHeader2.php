<?php

      include "../database.php";
      include "../bootstrap.php";

      // Retrieve data from Query String
      $id = $_GET['id'];

      // Escape User Input to help prevent SQL Injection
      $id = mysqli_real_escape_string($con,$id);

      $div = '';

      // Counting user's notifications
      $sql = "SELECT * FROM reports WHERE reportStatus=0";
      $result = $con->query($sql);
      $n = 0;
      if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                  $n++;
            }
            if($n == 1){
                  $div .= '
                        <a class="btn btn-dark" title="'.$n.' Notification" data-toggle="modal" data-target="#notificationModal" style="color: white;" onclick="ajaxHeader3();">
                              🔔<span class="badge badge-primary"> New : '.$n.'</span> 
                        </a>
                  ';
            }else{
                  $div .= '
                        <a class="btn btn-dark" title="'.$n.' Notifications" data-toggle="modal" data-target="#notificationModal" style="color: white;" onclick="ajaxHeader3();">
                              🔔<span class="badge badge-primary"> New : '.$n.'</span>
                        </a>
                  ';
            }
      }else{
            $div .= '
                  <a class="btn btn-dark" title="'.$n.' Notifications" data-toggle="modal" data-target="#notificationModal" style="color: skyblue;" onclick="ajaxHeader3();">
                      🔔<span class="badge badge-dark"> New : '.$n.'</span>
                  </a>
            ';
      }

      echo $div;
?>