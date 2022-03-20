<?php
    session_start();

    $username = $_POST["uname"];
    $password = $_POST["psw"];

    echo $username." ".$password;
    $_SESSION['login'] = $username;
    header('Location: userMenu.php');
?>