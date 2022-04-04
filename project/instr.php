<?php
    if (isset($_POST['uname'])&&isset($_POST['psw']) && $_POST['uname']!="" && $_POST['psw']!="") {
        
        session_start();
        $username = $_POST["uname"];
        $password = $_POST["psw"];
        //echo $username." ".$password;
        $url = "http://localhost:5000/api.php?instrLogin=".$username."&pass=".$password;
        //Call the phpinfo function.
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);

        if($result->login==true){
            $_SESSION['id'] = $result->id;
            //echo $result->id;
            header('Location: instrMenu.php');
        }else{
            header('Location: instrLogin.php');
        }
}
?>