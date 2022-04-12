<?php
    $con = new mysqli("IP","root","password","schema");
    if ($con->connect_error){
        echo "Failed to connect to MySQL: ";
        die();
    }

?>
