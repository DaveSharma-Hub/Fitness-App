<?php
if (isset($_POST['custIID']) && $_POST['custIID']!="" &&isset($_POST['custId']) && $_POST['custId']!=""&&isset($_POST['chatMsg']) && $_POST['chatMsg']!="" ){
    include ('db.php');
    $IID = $_POST['custIID'];
    $UID = $_POST['custId'];
    $MSG = $_POST['chatMsg'];

    echo $IID." ". $UID ." ". $MSG;
}
?>