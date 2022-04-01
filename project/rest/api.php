<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (isset($_GET['userID']) && $_GET['userID']!="") {
	include('db.php');
	$order_id = $_GET['userID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Users WHERE ID=?");
    $stmt->bind_param("i",$order_id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            $amount = $row['Fname'];
            $response_code = $row['Lname'];
            $email = $row['Email'];
            $username = $row['Username'];
            $response_desc = $row['Age'];
            response($order_id, $amount, $response_code,$response_desc,$email,$username);
            mysqli_close($con);
        }
    }
    else{
	response(NULL, NULL, 200,"No Record Found");
    }
}
// else{
// 	response(NULL, NULL, 400,"Invalid Request");
// 	}

if (isset($_GET['sleepUID']) && $_GET['sleepUID']!="") {
	include('db.php');
	$order_id = $_GET['sleepUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM sleep_tracker WHERE UID=?");
    $stmt->bind_param("i",$order_id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $max = 0;
    $slept = 0;
    if($stmt_result->num_rows>0){
       
        while($row = $stmt_result->fetch_array()){
            // $amount = $row['Fname'];
            // $response_code = $row['Lname'];
            // $email = $row['Email'];
            // $username = $row['Username'];
            // $response_desc = $row['Age'];
            if($row['SID']>=$max){
                    $slept = $row['hours_slept'];
                    $max = $row['SID'];
            }
        }
    }

    if($max!=0 &&$slept!=0){
        responseSleep($max,$slept);
        mysqli_close($con);
    }
    else{
	response(NULL, NULL, 200,"No Record Found");
    }
}

if (isset($_GET['userLogin']) && $_GET['userLogin']!="" && isset($_GET['pass']) && $_GET['pass']!="") {
	include('db.php');
	$username = $_GET['userLogin'];
    $password = $_GET['pass'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Users");
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            $DBusername = $row['Username'];
            $DBpsw = $row['pass'];
            if($DBusername == $username && $DBpsw == $password){
                $loggedIn = true;
                $id = $row['ID'];
                responseLogin($loggedIn,$id);
                mysqli_close($con);
            }
        }
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
	
}
// $url = "http://localhost:5000/api.php?userSignUp=".$username."&pass=".$password."&email=".$email
//         ."&age=".$age."&gender=".$gender;
// else{
// 	response(NULL, NULL, 400,"Invalid Request");
// 	}
if (isset($_GET['userSignUp']) && $_GET['userSignUp']!="" && isset($_GET['pass']) && $_GET['pass']!=""
&&isset($_GET['email']) && $_GET['email']!=""&& isset($_GET['age']) && $_GET['age']!=""&&
isset($_GET['fname']) && $_GET['fname']!="" &&isset($_GET['lname']) && $_GET['lname']!="") {

	include('db.php');

	    $username = $_GET["userSignUp"];
        $password = $_GET["pass"];
        $email = $_GET["email"];
        $age = $_GET["age"];
        $fname = $_GET["fname"];
        $lname = $_GET["lname"];

    //echo $order_id;
    $stmt = $con->prepare("INSERT INTO Users(Fname,Lname,Age,Username,pass,Email,AID) VALUES(?,?,?,?,?,?,?)");
	//$result = mysqli_query($con,);
    $admin = 1;
	$stmt->bind_param("ssisssi",$fname,$lname,$age,$username,$password,$email,$admin);
    $stmt->execute();

    $stmt = $con->prepare("SELECT * FROM Users");
	//$result = mysqli_query($con,);
    $admin = 1;
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            $DBusername = $row['Username'];
            $DBpsw = $row['pass'];
            $DBage = $row['Age'];
            $DBemail = $row['Email'];
            $DBFname = $row['Fname'];
            $DBLname = $row['Lname'];
            if($DBusername == $username && $DBpsw == $password &&$DBage==$age&&
            $DBemail==$email && $DBFname==$fname && $DBLname==$lname ){
                $loggedIn = true;
                $id = $row['ID'];
                responseLogin($loggedIn,$id);
                mysqli_close($con);
            }
        }
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
	
}
    function responseLogin($loggedIn,$id){
        $response['login'] = $loggedIn;
        $response['id'] = $id;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function response($order_id,$amount,$response_code,$response_desc,$email,$username){
        $response['userID'] = $order_id;
        $response['Fname'] = $amount;
        $response['Lname'] = $response_code;
        $response['Age'] = $response_desc;
        $response['Email'] = $email;
        $response['Username'] = $username;

        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseSleep($max,$slept){
        //$response['max'] = $max;
        $response['hours_slept'] = $slept;
        $json_response = json_encode($response);
        echo $json_response;
    }
?>