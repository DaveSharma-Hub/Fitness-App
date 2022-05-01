<?php
      $con = new mysqli("IP","root","password","fitnessApp");
      if ($con->connect_error){
          echo "Failed to connect to MySQL: ";
          die();
      }
  

?>
