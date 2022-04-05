<?php
if (isset($_POST['subscribeIID']) && $_POST['subscribeIID']!="" &&isset($_POST['subscribeUID']) && $_POST['subscribeUID']!="" ){
    include ('db.php');
    $IID = $_POST['subscribeIID'];
    $UID = $_POST['subscribeUID'];

    echo $IID." ". $UID;
}
?>