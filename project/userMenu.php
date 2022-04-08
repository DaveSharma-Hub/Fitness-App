<?php
    //include 'user.php';
    //  session_start();
    // $username = $_SESSION['login'];
    // if($username==null){
    //   header('Location: login.html');
    // }
    
    //include 'session.php';
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
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
canvas {
    padding-left: 0;
    padding-right: 0;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 100%;
    float:right;
}
.facts{
  margin:0 auto;
}
.Efacts{
  /* margin:0 auto; */
  width:30%;
  border-radius:10px;
  background-color:rgb(0,0,0,0.1);
  padding:10px;
  float:left;
}
.Dfacts{
   margin-left:40px;
   margin-right:10px;
  width:30%;
  border-radius:10px;
  background-color:rgb(0,0,0,0.1);
  padding:10px;
  float:left;
}
.Sfacts{
   margin-left:10px;
  width:30%;
  border-radius:10px;
  background-color:rgb(0,0,0,0.1);
  padding:10px;
  float:right;
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
  <a href="instructor.php" id="contact">Instructor</a>
</div>

<div class="facts">
<div class="Efacts">
  <h1>Exercise Facts</h1>
  <p1> 1. Music improves workout performance
Listening to music while exercising can improve work out performance by 15%.</p1>
<br><p1> 2. Exercising improves brain performance
Cardiovascular exercise helps create new brain cells. This enhances brainpower and brain activity.</p1>
<br><p1>3. Working out sharpens your memory
Exercising increases the production of cells that are responsible for learning and memory</p1>
<br><p1>4. Exercise prevents signs of ageing
If you exercise 3 times a week for 45 minutes, you can help prevent signs of ageing.<p1>
<br><p1>5. You get sick less often
Exercising regularly helps boost your immune system. This means you’ll get sick less often than people who don’t exercise.</p1>
<br><p1>6. A pound of muscle burns three times more calories than a pound of fat
Having more muscle than fat means you can consume more calories.</p1>
</div>
<div class="Dfacts">
  <h1>Diet Facts</h1>
  <p1> 1. Music improves workout performance
Listening to music while exercising can improve work out performance by 15%.</p1>
<br><p1> 2. Exercising improves brain performance
Cardiovascular exercise helps create new brain cells. This enhances brainpower and brain activity.</p1>
<br><p1>3. Working out sharpens your memory
Exercising increases the production of cells that are responsible for learning and memory</p1>
<br><p1>4. Exercise prevents signs of ageing
If you exercise 3 times a week for 45 minutes, you can help prevent signs of ageing.<p1>
<br><p1>5. You get sick less often
Exercising regularly helps boost your immune system. This means you’ll get sick less often than people who don’t exercise.</p1>
<br><p1>6. A pound of muscle burns three times more calories than a pound of fat
Having more muscle than fat means you can consume more calories.</p1>
</div>
<div class="Sfacts">
  <h1>Sleep Facts</h1>
  <p1> 1. Sleep boosts immunity
During the flu season, it’s recommended to sleep seven to eight hours sleep a night to help keep your hardworking immune system in tip top shape.</p1>
<br><p1> 2. A new bed can increase the amount of sleep you get
According to The Sleep Council, you can get an extra 42 minutes sleep when you trade in your old bed for a new one.</p1>
<br><p1>3. Altitude affects sleep
When you're at altitude (approx. 13,200 ft plus), there is less oxygen which makes it much harder to go to sleep.</p1>
<br><p1>4. It should take 10 – 15 minutes to fall asleep
This is the ideal amount of time it takes to fall asleep. If you find yourself dropping off in 5 minutes or under, the likelihood is your suffering from sleep deprivation.<p1>
<br><p1>5. Sleep is different for men and women
According to the National Sleep Foundation, male and female circadian rhythms are slightly different. On average, men have a longer circadian rhythm by six minutes. Women are more likely to have a shorter cycle, meaning they are more prone to waking up earlier. </p1>
<!-- <br><p1>6. A pound of muscle burns three times more calories than a pound of fat
Having more muscle than fat means you can consume more calories.</p1> -->
</div>
</div>
<!-- <div style="width:90%;margin:0 auto;">
    <canvas id="myChart" style="max-width:600px;left:0"></canvas>
    <canvas id="myChart2" style="max-width:600px;left:0"></canvas>
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
