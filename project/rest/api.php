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

if (isset($_GET['sleepScheduleUID']) && $_GET['sleepScheduleUID']!="") {
	include('db.php');
	$order_id = $_GET['sleepScheduleUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM weekSleepSchedule WHERE UID=?");
    $stmt->bind_param("i",$order_id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $max = 0;
    $mon = 0;
    $tue = 0;
    $wed = 0;
    $thur = 0;
    $fri = 0;
    $sat = 0;
    $sun = 0;
    if($stmt_result->num_rows>0){
       
        while($row = $stmt_result->fetch_array()){
            // $amount = $row['Fname'];
            // $response_code = $row['Lname'];
            // $email = $row['Email'];
            // $username = $row['Username'];
            // $response_desc = $row['Age'];
            if($row['ID']>=$max){
                    $mon = $row['monday'];
                    $tue = $row['tuesday'];
                    $wed = $row['wednesday'];
                    $thur = $row['thursday'];
                    $fri = $row['friday'];
                    $sat = $row['saturday'];
                    $sun = $row['sunday'];
                    $max = $row['ID'];
            }
        }
    }
    if($max!=0 &&$mon!=0&&$tue!=0&&$wed!=0&&$thur!=0&&$fri!=0&&$sat!=0&&$sun!=0){
        responseSleepSchedule($max,$mon,$tue,$wed,$thur,$fri,$sat,$sun);
        mysqli_close($con);
    }
    else{
	response(NULL, NULL, 200,"No Record Found");
    }
}
if (isset($_GET['sleepRecommendedUID']) && $_GET['sleepRecommendedUID']!="") {
	include('db.php');
	$order_id = $_GET['sleepRecommendedUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM sleep_schedule,sleep_tracker WHERE sleep_tracker.UID=? AND
    sleep_tracker.SID=sleep_schedule.SID");
    $stmt->bind_param("i",$order_id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $max = 0;
    $time = 0;
    
    if($stmt_result->num_rows>0){
       
        while($row = $stmt_result->fetch_array()){
            // $amount = $row['Fname'];
            // $response_code = $row['Lname'];
            // $email = $row['Email'];
            // $username = $row['Username'];
            // $response_desc = $row['Age'];
            $time = $row['sleep_time'];
        }
    }
    if($time!=0){
        responseSleepScheduleRec($max,$time);
        mysqli_close($con);
    }
    else{
	response(NULL, NULL, 200,"No Record Found");
    }
}

if (isset($_GET['exerciseCalorieUID']) && $_GET['exerciseCalorieUID']!="") {
	include('db.php');
	$order_id = $_GET['exerciseCalorieUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT calories_spent,timeSpent FROM exercise_tracker WHERE UID=?");
    $stmt->bind_param("i",$order_id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $max = 0;
    $time = 0;
    $cal=array();
    $time=array();
    if($stmt_result->num_rows>0){
       
         while($row = $stmt_result->fetch_array()){
        //     // $amount = $row['Fname'];
        //     // $response_code = $row['Lname'];
        //     // $email = $row['Email'];
        //     // $username = $row['Username'];
        //     // $response_desc = $row['Age'];
        //     $time = $row['sleep_time'];
        // }
        array_push($cal,$row['calories_spent']);
        array_push($time,$row['timeSpent']);
         }
    }
    if($time!=0 && $cal!=0){
        responseExerciseCalorie($cal,$time);
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
if (isset($_GET['dietCalID']) && $_GET['dietCalID']!="") {
	include('db.php');
	$id = $_GET['dietCalID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Diet_tracker where Diet_tracker.UID = ?");
	//$result = mysqli_query($con,);
	$stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $date = new DateTime();
    $today = $date->format('Y-m-d');
    $cal = 0;
    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            if($row['dateDiet'] == $today){ 
                $cal += $row['calories_intake'];
            }
        }
    }
    if($cal != 0){
        responseCalories($cal);
        mysqli_close($con);
    }
    else{
        response(NULL, NULL, 200, "No Record Found");
    }
	
}
if (isset($_GET['dietID']) && $_GET['dietID']!="") {
	include('db.php');
	$id = $_GET['dietID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Recipes, Diet_tracker where Recipes.DID = Diet_tracker.DID AND Diet_tracker.UID = ?");
	//$result = mysqli_query($con,);
	$stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $cal = array();
    $ing = array();
    $steps = array();
    $name = array();
    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            // $steps = $row['steps'];
            // $ingredients = $row['ingredients'];
            // $calories = $row['calories'];
            array_push($cal, $row['calories']);
            array_push($ing, $row['ingredients']);
            array_push($steps, $row['steps']);
            array_push($name, $row['name']);
        }
    }
    if($cal != 0 && $ing != 0 && $steps != 0 && $name != 0){
        responseCard($cal, $ing, $steps, $name);
        mysqli_close($con);
    }
    else{
        response(NULL, NULL, 200, "No Record Found");
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
    function responseSleepSchedule($max,$mon,$tue,$wed,$thur,$fri,$sat,$sun){
        //$response['max'] = $max;
        $response['mon'] = $mon;
        $response['tue']= $tue;
        $response['wed']= $wed;
        $response['thur']= $thur;
        $response['fri']= $fri;
        $response['sat']= $sat;
        $response['sun']= $sun;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseSleepScheduleRec($max,$time){
        //$response['max'] = $max;
        $response['time'] = $time;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseExerciseCalorie($cal,$time){
        $response['time'] = $time;
        $response['cal'] = $cal;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseCard($cal,$ing,$steps,$name){
        $response['cal'] = $cal;
        $response['ing']= $ing;
        $response['steps']= $steps;
        $response['name']= $name;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseCalories($cal){
        $response['cal'] = $cal;
        $json_response = json_encode($response);
        echo $json_response;
    }

?>