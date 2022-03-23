<?php
    //include 'user.php';
    session_start();
    $username = $_SESSION['login'];
    if($username==null){
      header('Location: login.html');
    }
?>
<!DOCTYPE html>
<html>
<head>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet"> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<style>
body{
    background-color:white;
    font-family: 'Quicksand', cursive;
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

.Ureport{
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    width:48%;
    height:100%;
    float:left;
    justify-items:center;
}
.Ureport h1{
    text-align:center;
}
.Ireport{
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    width:48%;
    height:100%;
    float:right;
    justify-items:center;
}
.Ireport h1{
    text-align:center;
}
</style>
</head>
<body onload="startTime()">
<div class="topnav">
  <a href="#">Logout</a>
  <a href="#news">My Account</a>
  <a class="active" href="#home">Home</a>
</div>
<main class="container" id="mainContainer">
  <div id="col-1"></div>
  <div id="col-2"><div id="icon">
</main>
<div class="welcome">
  <h3>Welcome Admin <?php echo $username ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="userInfo.php" id="about">Users</a>
  <a href="instructorInfo.php" id="blog">Instructors</a>
  <!-- <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a> -->
</div>

<div class="Ureport">
    <h1>User Report</h1>
    <p>Number of users: 100</p>
    <div style="position:relative;">
    <canvas id="myChartBarUser" style="max-width:400px;left:0"></canvas>
    </div>
</div>

<div class="Ireport">
    <h1>Instructor Report</h1>
    <p>Number of instructors: 8</p>
    <div style="position:relative;">
    <canvas id="myChartBarInst" style="max-width:400px;left:0"></canvas>
    </div>
</div>


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
  greeting = "Good Morning Admin";
  icon = "coffee";
  color="rgb(232,232,232)";
}
else if (hourNow < 20){
  greeting = 'Good afternoon Admin!';
  icon = "sun-o";
  color="rgb(156,156,156)";
}
else if (hourNow < 24){
  greeting = "Good evening Admin";
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

var xValuesU = ["Active Users", "Non-Active Users"];
var yValuesU = [100, 10];
var barColorsU = ["green", "red"];

new Chart("myChartBarUser", {
  type: "bar",
  data: {
    labels: xValuesU,
    datasets: [{
      backgroundColor: barColorsU,
      data: yValuesU
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "User Account Information"
    }
  }
});

var xValuesI = ["Active Instructors", "Non-Active Instructors"];
var yValuesI = [10, 3];
var barColorsI = ["green", "red"];

new Chart("myChartBarInst", {
  type: "bar",
  data: {
    labels: xValuesI,
    datasets: [{
      backgroundColor: barColorsI,
      data: yValuesI
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Instructor Account Information"
    }
  }
});
</script>
</html> 
