<?php
header("Content-Type:application/json");
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
            $response_desc = $row['Age'];
            response($order_id, $amount, $response_code,$response_desc);
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
// else{
// 	response(NULL, NULL, 400,"Invalid Request");
// 	}

    function responseLogin($loggedIn,$id){
        $response['login'] = $loggedIn;
        $response['id'] = $id;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function response($order_id,$amount,$response_code,$response_desc){
        $response['userID'] = $order_id;
        $response['Fname'] = $amount;
        $response['Lname'] = $response_code;
        $response['Age'] = $response_desc;
        
        $json_response = json_encode($response);
        echo $json_response;
    }
?>