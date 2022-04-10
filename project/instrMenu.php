<?php
    //include 'user.php';
    session_start();
    $id = $_SESSION['id'];//1 ;// FROM THE SESSION 
    $url = "http://localhost:5000/api.php?instrID=".$id;
	
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);

?>
<!DOCTYPE html>
<html>
<head>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet"> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
body{
    background-color:white;
    font-family: 'Quicksand', cursive;

}
.topnav {
  margin-left:7%;
  width:90%;
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
  width: 150px;
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

.insReview{
  width:50%;
  background-color:rgb(0,0,0,0.1);
  border-radius:10px;
  height:50vh;  
  overflow-y:auto;
  float:right;
}
.pic{
  display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh;
    font-family: 'Quicksand', cursive;
    font-size: 2em;
    color: #666;
}
</style>
</head>
<body onload="start()">
<input type="hidden" id="custId" name="custId" value=<?php echo $id?>> 

<div class="topnav">
  <a href="instrLogin.php">Logout</a>
  <a href="instructorMyAccount.php">My Account</a>
  <a class="active" href="instrMenu.php">Home</a>
</div>
<main class="container" id="mainContainer">
  <div id="col-1"></div>
  <div id="col-2"><div id="icon">
</main>
<div class="welcome">
  <h3>Welcome <?php echo $result->Fname." ".$result->Lname ?></h3>
</div>
<div class="pic">
    <img src='index.png'/>
  </div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="instrExercise.php" id="about">Update Exercise</a>
  <a href="instrSleep.php" id="blog">Update Sleep</a>
  <a href="instrDiet.php" id="projects">Update Diet</a>
  <a href="instrMsg.php" id="contact">Messages</a>
</div>
<!-- 
<div style="position:relative;">
    <canvas id="myChart" style="max-width:400px;left:0"></canvas>
    <canvas id="myChart2" style="max-width:400px;left:0"></canvas>
</div> -->
<div class="outer">
<div style="float:left;position:relative;background-color:rgb(0,0,0,0.1);border-radius:10px;height:50vh">
    <canvas id="myChart" style="width:660px;margin-top:20px;"></canvas>
</div>
<div class="insReview">
  <h1>Your Reviews</h1>
<?php
    $url = "http://localhost:5000/api.php?getReviewsIID=".$id;
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $resultR = json_decode($response);
    echo "<div class='reviews'>";
    for($j=0;$j<count($resultR->review);$j++){
      echo "<p> <img src='https://www.shareicon.net/data/512x512/2017/01/06/868320_people_512x512.png' style='width:30px;height:30px;'>".$resultR->review[$j]."</p>";
    }
    echo"</div>";
?>
</div>
  </div>
</body>
<script>
  var id = document.getElementById("custId").value;

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
var xValuesU = ["Total Subscribed Of Users"];
  var barColorsU = ["rgba(54, 162, 235, 1)"];
function barChart(){
  
  
  //   const xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onload = function() {
  //     json=this.responseText;
  //   }
  // xmlhttp.open("GET", "http://localhost:5000/api.php?sleepUID="+id);
  // xmlhttp.send();
    $.ajax({
          url: "http://localhost:5000/api.php?instructorNumUsers="+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res);
              //json = res;
              //alert(res);
              var data = [res].map(function(e) {
                    if(res==null){return [0];}
                    else{return e.count;}
              });;
              // var arr = [4, 6, 6, 5, 5.5, 8, 9];
              //console.log(arr);
               console.log(data);
              new Chart("myChart", {
                type: "bar",
                data: {
                  labels: xValuesU,
                  datasets: [{
                    backgroundColor: barColorsU,
                    borderColor: ['rgb(54, 162, 235)'],
                    data: data
                  }]
                },
                options: {
                  legend: {display: false},
                  title: {
                    display: true,
                    text: "Number of Users Subscribed to You"
                  }
                }
              }); 
          }
      });
}

function start(){
  barChart();
  startTime();
}
</script>
</html> 
