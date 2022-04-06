<?php
    //include 'user.php';
    //session_start();
    // $username = $_SESSION['login'];
    // if($username==null){
    //   header('Location: login.html');
    // }
    session_start();
    $id = $_SESSION['id'];//1 ;// FROM THE SESSION 
    $url = "http://localhost:5000/api.php?userID=".$id;
	
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);

?>
<!DOCTYPE html>
<html>
<head>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<style>
body{
    background-color:white;
}
.topnav {
  margin-left:5%;
  width:95%;
  overflow: hidden;
  background-color: rgb(82,16,238);
  border-radius:10px;
}

.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: rgb(109,109,255);
  color: black;
}

.topnav a.active {
  background-color: rgb(204,0,102);
  color: white;
}


#mySidenav a {
  padding-top:100px;
  position: absolute;
  left: -94px;
  transition: 0.3s;
  padding: 15px;
  padding-right:18px;
  width: 100px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 0 5px 5px 0;
}
#mySidenav a:hover {
  left: 0;
}

#about {
  top: 20px;
  background-color: #04AA6D;
}

#blog {
  top: 80px;
  background-color: #2196F3;
}

#projects {
  top: 140px;
  background-color: #f44336;
}

#contact {
  top: 200px;
  background-color: #555
}
.container{
 display: flex;
 justify-content: center;
 align-items: center;
 height: 10vh;
 font-family: 'Quicksand', cursive;
 font-size: 2em;
 color: #666;
}
.fa{
  margin-left: 20px;
  color: #b3b300;
}
#txt{
 display: flex;
 justify-content: center;
 align-items: center;
 height: 10vh;
 font-family: 'Quicksand', cursive;
 font-size: 2em;
 color: #666;
}
.welcome{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh;
    font-family: 'Quicksand', cursive;
    font-size: 2em;
    color: #666;
}
.subscribe{
    background-color:rgb(0,0,0,0.1);
    font-family: 'Quicksand', cursive;
    border-radius:10px;
    width:48%;
    float:left;
    text-align:center;
}
.subscribe a{
    /* float:right; */
    background-color: #f06262;
    text-align: center;
    text-decoration: none;
    font-size: 17px;
    border-radius:5px;
    color:white;
    padding:1px;
}
.subscribe #review{
    background-color: #f0a062;
    text-align: center;
    text-decoration: none;
    font-size: 17px;
    border-radius:5px;
    color:white;
    padding:1px;
}
.chat{
    background-color:rgb(0,0,0,0.1);
    font-family: 'Quicksand', cursive;
    border-radius:10px;
    float:right;
    width:48%;
    text-align:center;
}
button{
    /* float:right; */
    background-color: blue;
    text-align: center;
    text-decoration: none;
    font-size: 17px;
    border-radius:5px;
    color:white;
    padding:2px;
    border:none;
    cursor:pointer;
}

.checked {
  color: orange;
}
</style>
</head>
<body onload="startTime()">
<div class="topnav">
  <a href="login.php">Logout</a>
  <a href="myAccount.php">My Account</a>
  <a class="active" href="userMenu.php">Home</a>
</div>
<main class="container" id="mainContainer">
  <div id="col-1"></div>
  <div id="col-2"><div id="icon">
</main>
<div class="welcome">
  <h3>Welcome <?php echo $result->Fname." ".$result->Lname ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="exercise.php" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="#" id="contact">Instructor</a>
</div>
<div class="outer">
    <div class="subscribe">
        <h1>Instructor Subscription</h1>

        <?php
          $url = "http://localhost:5000/api.php?getInstructorUID=".$id;
	
          $client = curl_init($url);
          curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
          $response = curl_exec($client);
          $result2 = json_decode($response);

            for($i=0;$i<count($result2->ids);$i++){
                echo "<p>";
                if($result2->star[$i]==0){
                    echo "	&#9733;&#9733;&#9733;&#9733;&#9733;";
                }
                else if($result2->star[$i]==1){
                  echo "	&#11088;&#9733;&#9733;&#9733;&#9733;";
                 }
                 else if($result2->star[$i]==2){
                  echo "	&#11088;&#11088;&#9733;&#9733;&#9733;";
                 }
                 else if($result2->star[$i]==3){
                  echo "	&#11088;&#11088;&#11088;&#9733;&#9733;";
                 }
                 else if($result2->star[$i]==4){
                  echo "	&#11088;&#11088;&#11088;&#11088;&#9733;";
                 }
                else{
                    echo "	&#11088;&#11088;&#11088;&#11088;&#9733;	";
                }
                echo "Instructor ".$result2->fname[$i]." ".$result2->lname[$i]."&nbsp&nbsp&nbsp&nbsp&nbsp<a href='#'>Subscribe</a>&nbsp&nbsp<a id='review' href='#'>Reviews</a></p>";
            }
        ?>
    </div>
    <div class="chat">
        
        <h1>Instructor Chat</h1>
        <h4>(Instructors you have subscribed too)</h4>

        <?php
        $url = "http://localhost:5000/api.php?getMyInstructorUID=".$id;
	
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result3 = json_decode($response);
        
            for($i=0;$i<count($result3->IID);$i++){
                echo "<form action='chat.php' method='post'><p>Instructor ".$result3->FName[$i]." ".$result3->LName[$i]."&nbsp&nbsp&nbsp&nbsp&nbsp<button type='Submit'>Chat</button></p><input type='hidden' id='IID' name='IID' value=".$result3->IID[$i]."> 
                <input type='hidden' id='ifname' name='ifname' value=".$result3->FName[$i]."><input type='hidden' id='ilname' name='ilname' value=".$result3->LName[$i]."></form>";
            }
            //WE CAN MAKE THE ABOVE 2 INTO A FORM!!!!!!!!!!
        ?>
    </div>
</div>
<!-- <div style="position:relative;">
    <canvas id="myChart" style="max-width:400px;left:0"></canvas>
    <canvas id="myChart2" style="max-width:400px;left:0"></canvas>
</div> -->

</body>
<script>
var today = new Date();
var hourNow = today.getHours();
var greeting;
var icon;
var rn = today.toTimeString();
var msg = "\nCurrent time is ";//+":"today.minutes();
msg = msg.concat(rn);
var color;
if (hourNow < 12){
  greeting = "Good Morning";
  icon = "coffee";
  color="rgb(232,232,232)";
}
else if (hourNow < 20){
  greeting = 'Good afternoon!';
  icon = "sun-o";
  color="rgb(156,156,156)";
}
else if (hourNow < 24){
  greeting = "Good evening";
  icon = "moon-o";
  color="rgb(95,95,95)";
}
else {
  greeting = "Welcome";
}

document.getElementById("col-1").innerHTML = "<h3>" + greeting + " </h1>";

document.getElementById("icon").innerHTML = ('<i class="fa fa-' + icon + '" aria-hidden="true"></i>');
// document.getElementById("mainContainer").backgroundColor =color;
document.getElementById("mainContainer").backgroundImage="linear-gradient(to right, red , yellow);"
function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
var xValues = ["Vegtables", "Protien", "Carbohydrates", "Dairy"];
var yValues = [55, 49, 44, 24];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
];

new Chart("myChart", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Your Overall Diet"
    }
  }
});
var xValues = [50,60,70,80,90,100,110,120,130,140,150];
var yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart2", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: "rgba(0,0,0,1.0)",
      borderColor: "rgba(0,0,0,0.1)",
      data: yValues
    }]
  },
  options:{
      title: {
      display: true,
      text: "Your Overall Diet"
    }
  }
});
</script>
</html> 
