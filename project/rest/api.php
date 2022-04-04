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
    $test =0;
    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            $test = $row['dateDiet'];
            //if(strtotime($row['dateDiet']) == strtotime($today)){ 
                $cal += $row['calories_intake'];
            //}
        }
    }
    if($cal>=0){
        responseCalories($today);
        mysqli_close($con);
    }
    else{
        response(NULL, NULL, 200, "No Record Found");
        //responseCalories();
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


if (isset($_GET['getInstructorUID']) && $_GET['getInstructorUID']!="" ) {
	include('db.php');
	$username = $_GET['getInstructorUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Instructor");
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    $ids = array();
    $fname =array();
    $lname = array();
    $star = array();

    if($stmt_result->num_rows>0){
        while($row = $stmt_result->fetch_array()){
            // $DBusername = $row['Username'];
            // $DBpsw = $row['pass'];
            // if($DBusername == $username && $DBpsw == $password){
            //     $loggedIn = true;
            //     $id = $row['ID'];
            //     responseLogin($loggedIn,$id);
            //     mysqli_close($con);
            // }
            $id = $row['IID'];
            $f = $row['FName'];
            $l = $row['LName'];
            $s = $row['star_rating'];
            array_push($ids,$id);
            array_push($fname,$f);
            array_push($lname,$l);
            array_push($star,$s);
        }
    }

    if($ids!=0 && $fname!=0 && $lname!=0 &&$star!=0){
        responseInstructorCard($ids, $fname, $lname,$star);
        mysqli_close($con);
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
}

if (isset($_GET['getMyInstructorUID']) && $_GET['getMyInstructorUID']!="" ) {
	include('db.php');
	$username = $_GET['getMyInstructorUID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM subscribe,Instructor WHERE Instructor.IID=subscribe.IID AND UID=?");
    $stmt->bind_param("i",$username);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    $ids = array();
    $fname = array();
    $lname = array();

    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            // $DBusername = $row['Username'];
            // $DBpsw = $row['pass'];
            // if($DBusername == $username && $DBpsw == $password){
            //     $loggedIn = true;
            //     $id = $row['ID'];
            //     responseLogin($loggedIn,$id);
            //     mysqli_close($con);
            // }
            $id = $row['IID'];
            $f = $row['FName'];
            $l = $row['LName'];
            array_push($ids,$id);
            array_push($fname,$f);
            array_push($lname,$l);
        }
    }

    if($ids!=0 && $fname!=0 && $lname!=0){
        responseMyInstructorCard($ids,$fname,$lname);
        mysqli_close($con);
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
}

if (isset($_GET['exerciseTypeID']) && $_GET['exerciseTypeID']!="") {
	include('db.php');
	$id = $_GET['exerciseTypeID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM exercise_tracker WHERE UID=?");
    $stmt->bind_param("i",$id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    $cardio = 0;
    $flex = 0;
    $strength = 0;

    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            if($row['exerciseType']=="Cardio"){
                $cardio+=$row['calories_spent'];
            }
            else if($row['exerciseType']=="Flexibility"){
                $flex+=$row['calories_spent'];
            }
            else if($row['exerciseType']=="Strength"){
                $strength+=$row['calories_spent'];
            }
            // $id = $row['IID'];
            // $f = $row['FName'];
            // $l = $row['LName'];
            // array_push($ids,$id);
            // array_push($fname,$f);
            // array_push($lname,$l);
        }
    }

    if($cardio!=0 && $flex!=0 && $strength!=0){
        responseExerciseType($cardio,$flex,$strength);
        mysqli_close($con);
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
}

if (isset($_GET['getChatData']) && $_GET['getChatData']!="" &&isset($_GET['IID']) && $_GET['IID']!="" ) {
	include('db.php');
	$username = $_GET['getChatData'];
    $iid = $_GET['IID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM Messages WHERE IID=? AND UID=?");
    $stmt->bind_param("ii",$iid,$username);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    $IID = array();
    $UID = array();
    $msg = array();

    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            // $DBusername = $row['Username'];
            // $DBpsw = $row['pass'];
            // if($DBusername == $username && $DBpsw == $password){
            //     $loggedIn = true;
            //     $id = $row['ID'];
            //     responseLogin($loggedIn,$id);
            //     mysqli_close($con);
            // }
            $id = $row['IID'];
            $f = $row['FName'];
            $l = $row['LName'];
            array_push($ids,$id);
            array_push($fname,$f);
            array_push($lname,$l);
        }
    }

    if($ids!=0 && $fname!=0 && $lname!=0){
        responseMyInstructorCard($ids,$fname,$lname);
        mysqli_close($con);
    }
    else{
        $loggedIn = false;
	    responseLogin($loggedIn,NULL);
    }
}

if (isset($_GET['personalHealthID']) && $_GET['personalHealthID']!="") {
	include('db.php');
	$id = $_GET['personalHealthID'];
    //echo $order_id;
    $stmt = $con->prepare("SELECT * FROM personal_health_information WHERE UID=?");
    $stmt->bind_param("i",$id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            $w = $row['weight'];
            $h = $row['height'];
            $b = $row['BMI'];
            if($w!=0 && $h!=0 && $b!=0){
                responsePersonalHealth($w,$h,$b);
                mysqli_close($con);
            }
        }
    }
    else{
        // $loggedIn = false;
	    // responseLogin($loggedIn,NULL);
    }
}

if (isset($_GET['dietInfoID']) && $_GET['dietInfoID']!="") {
	include('db.php');
	$id = $_GET['dietInfoID'];
    //echo $order_id;
    $date = new DateTime();
    $today = $date->format('Y-m-d');

    $stmt = $con->prepare("SELECT * FROM FoodItems WHERE UID=?");
    $stmt->bind_param("i",$id);
	//$result = mysqli_query($con,);
	
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    $fat=0; 
    $sugar=0;
    $protein=0;
    $sodium=0;
    $carbs=0;

    $counter=0;
    if($stmt_result->num_rows>0){

        while($row = $stmt_result->fetch_array()){
            $counter++;

            //if((($row['TodayDate']))==($today)){
                $fat += $row['Fat'];
                $sugar += $row['Sugar'];
                $protein += $row['Protein'];
                $carbs += $row['Carbohydrates'];
                $sodium += $row['Sodium'];
            //}
        }
    }
    if($fat!=0 && $sugar!=0&& $protein!=0 && $carbs!=0 && $sodium!=0){
        responseDietInfo($fat,$sugar,$protein,$carbs,$sodium);
        mysqli_close($con);
    }
    else{
         $loggedIn = false;
	    responseLogin($counter,NULL);
    }
}


if (isset($_POST['myAccountFname']) && $_POST['myAccountFname']!="" &&
isset($_POST['myAccountLname']) && $_POST['myAccountLname']!="" &&
isset($_POST['myAccountEmail']) && $_POST['myAccountEmail']!="" &&
isset($_POST['myAccountAge']) && $_POST['myAccountAge']!="" &&
isset($_POST['myAccountUsername']) && $_POST['myAccountUsername']!=""&&
isset($_POST['myAccountPsw']) && $_POST['myAccountPsw']!="") {
    //echo "Testing";
	 include('db.php');
	 $fname = $_POST['myAccountFname'];
     $lname = $_POST['myAccountLname'];
     $email = $_POST['myAccountEmail'];
     $age = $_POST['myAccountAge'];
     $username = $_POST['myAccountUsername'];
     $psw = $_POST['myAccountPsw'];
     $Id = $_POST['custId'];
    // //echo $order_id;
    $stmt = $con->prepare("UPDATE Users SET Fname = ?,Lname=?,Age=?,Username=?,pass=?,Email=?,AID=? WHERE ID = ?");
    $aid = 1;
    // //$result = mysqli_query($con,);
	 $stmt->bind_param("ssisssii",$fname,$lname,$age,$username,$psw,$email,$aid,$Id);
     $stmt->execute();
     echo 1;
    // $stmt_result = $stmt->get_result();
    // $cal = array();
    // $ing = array();
    // $steps = array();
    // $name = array();
    // if($stmt_result->num_rows>0){
    //     while($row = $stmt_result->fetch_array()){
    //         // $steps = $row['steps'];
    //         // $ingredients = $row['ingredients'];
    //         // $calories = $row['calories'];
    //         array_push($cal, $row['calories']);
    //         array_push($ing, $row['ingredients']);
    //         array_push($steps, $row['steps']);
    //         array_push($name, $row['name']);
    //     }
    // }
    // if($cal != 0 && $ing != 0 && $steps != 0 && $name != 0){
    //     responseCard($cal, $ing, $steps, $name);
    //     mysqli_close($con);
    // }
    // else{
    //     response(NULL, NULL, 200, "No Record Found");
    // }
	
}
if (isset($_POST['food_item']) && $_POST['food_item']!="" &&
isset($_POST['cals']) && $_POST['cals']!="" &&
isset($_POST['sugar']) && $_POST['sugar']!="" &&
isset($_POST['fat']) && $_POST['fat']!=""&&
isset($_POST['protein']) && $_POST['protein']!="" &&
isset($_POST['carbs']) && $_POST['carbs']!=""&&
isset($_POST['sodium']) && $_POST['sodium']!="") {
    //echo "Testing";
	 include('db.php');
	 $food_item = $_POST['food_item'];
     $cals = $_POST['cals'];
     $sugar = $_POST['sugar'];
     $fat = $_POST['fat'];
     $protein = $_POST['protein'];
     $carbs = $_POST['carbs'];
     $sodium = $_POST['sodium'];
     $Id = $_POST['uid'];
     $date = new DateTime();
    $today = $date->format('Y-m-d');
    // //echo $order_id;
    $stmt = $con->prepare("INSERT INTO FoodItems (UID,TodayDate,FoodItem,Calories,Sugar,Fat,Protein,Carbohydrates,Sodium) VALUES (?,?,?,?,?,?,?,?,?)");
    $aid = 1;
    // //$result = mysqli_query($con,);
	 $stmt->bind_param("issiiiiii",$Id,$today,$food_item,$cals,$sugar,$fat,$protein,$carbs,$sodium);
     $stmt->execute();
     echo 1;
     $stmt = $con->prepare("INSERT INTO Diet_tracker (UID,calories_intake,dateDiet) VALUES (?,?,?)");
     $aid = 1;
    $stmt->bind_param("iis",$Id,$cals,$today);
    $stmt->execute();
    echo 1;		
}
if (isset($_POST['sleeptime']) && $_POST['sleeptime']!="" &&
isset($_POST['wakeuptime']) && $_POST['wakeuptime']!="" ){
    //echo "Testing";
	 include('db.php');
	 $sleep = $_POST['sleeptime'];
     $wake = $_POST['wakeuptime'];
    $Id = $_POST['Sleepuid'];
    $date = new DateTime();
    $today = $date->format('Y-m-d');
    $start = new DateTime($sleep);
    $end = new DateTime($wake);
    $sleepDiff = $start->diff($end);
    $sleepHours = $sleepDiff->format("%H");
    $weekday = date('w');
    $stmt = $con->prepare("INSERT INTO sleep_tracker (hours_slept, UID, TodayDate) VALUES (?,?,?) ON DUPLICATE KEY UPDATE hours_slept = ?");
    // //$result = mysqli_query($con,);
	 $stmt->bind_param("iisi",$sleepHours,$Id,$today,$sleepHours);
     $stmt->execute();
     echo 1;
    if($weekday == 0){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET sunday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 1){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET monday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 2){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET tuesday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 3){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET wednesday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 4){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET thursday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 5){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET friday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
    else if($weekday == 6){
        $stmt = $con->prepare("UPDATE weekSleepSchedule SET saturday=? WHERE UID = ?");
        $stmt->bind_param("ii",$sleepHours,$Id);
        $stmt->execute();
        echo 1;
    }
}
if (isset($_POST['textNotes']) && $_POST['textNotes']!=""){
    //echo "Testing";
	 include('db.php');
	 $notes = $_POST['textNotes'];
    $Id = $_POST['Noteuid'];
    $date = new DateTime();
    $today = $date->format('Y-m-d');
    // //echo $order_id;
    $stmt = $con->prepare("INSERT INTO SleepNotes (UID, TodayDate, Notes) VALUES (?,?,?) ON DUPLICATE KEY UPDATE Notes = ?");
    $aid = 1;
    // //$result = mysqli_query($con,);
	 $stmt->bind_param("isss",$Id,$today,$notes,$notes);
     $stmt->execute();
     echo 1;
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
   function responseInstructorCard($ids, $fname, $lname,$star){
        $response['ids'] = $ids;
        $response['fname'] = $fname;
        $response['lname'] = $lname;
        $response['star'] = $star;
        $json_response = json_encode($response);
        echo $json_response;
   }
   function responseMyInstructorCard($stmt,$fname,$lname){
        $response['IID'] = $stmt;
        $response['FName'] = $fname;
        $response['LName'] = $lname;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responsePersonalHealth($w,$h,$b){
        $response['weight'] = $w;
        $response['height'] = $h;
        $response['bmi'] = $b;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseExerciseType($cardio,$flex,$strength){
        $response['cardio'] = $cardio;
        $response['flexibility'] = $flex;
        $response['strength'] = $strength;
        $json_response = json_encode($response);
        echo $json_response;
    }
    function responseDietInfo($fat,$sugar,$protein,$carbs,$sodium){
        $response['fat'] = $fat;
        $response['sugar'] = $sugar;
        $response['protein'] = $protein;
        $response['carbs'] = $carbs;
        $response['sodium'] = $sodium;
        
        $json_response = json_encode($response);
        echo $json_response;
    }


?>