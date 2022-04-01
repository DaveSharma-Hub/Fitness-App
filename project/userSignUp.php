<?php

   /// include 'session.php';
if (isset($_POST['uname'])&&isset($_POST['psw']) && $_POST['uname']!="" && $_POST['psw']!="" &&
isset($_POST['email'])&&isset($_POST['age']) && $_POST['email']!="" && $_POST['age']!="" &&
isset($_POST['fname']) && $_POST['fname']!="" && isset($_POST['lname']) && $_POST['lname']!="") {
       // echo $_POST['uname'];
        //session_start();
        $username = $_POST["uname"];
        $password = $_POST["psw"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];

       // echo $username." ".$password." ".$email." ".$age." ".$fname." ".$lname;
        $url = "http://localhost:5000/api.php?userSignUp=".$username."&pass=".$password."&email=".$email
        ."&age=".$age."&fname=".$fname."&lname=".$lname;
        
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);

        if($result->login==true){
            session_start();
            $_SESSION['id'] = $result->id;
            //$session_id = $result->id;
            //echo $result->id;
            header('Location: userMenu.php');
        }else{
            header('Location: login.php');
        }
}
?>