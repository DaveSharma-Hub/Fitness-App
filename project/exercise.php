<?php
    //include 'user.php';
    session_start();
    $username = $_SESSION['login'];
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
.sticky{
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: +2;
    background-color:rgb(255,255,255,1);
    padding:0;
}
.topnav {
  margin-left:5%;
  width:95%;
  overflow: hidden;
  background-color: rgb(82,16,238);
  border-radius:10px;
  position: -webkit-sticky;
  position: sticky;
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
  left: -97px;
  transition: 0.3s;
  padding: 15px;
  padding-right:18px;
  width: 103px;
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
 font-size: 1em;
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
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius:10px;
}
.outside{
    margin:0 auto;
}
.title{
    width:48%;
    float:left;
    font-family: 'Quicksand', cursive;
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    padding:10px;
}
.title2{
    width:48%;
    float:right;
    font-family: 'Quicksand', cursive;
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    padding:10px;
}
/* Set a style for all buttons */
button {
  background-color: red;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  border-radius:10px;
  width: 100%;
}

button:hover {
  opacity: 0.7;
  background-color:blue;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
  border-radius:10px;

}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
  border-radius:10px;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.8s;
  animation: animatezoom 0.8s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

canvas {
    padding-left: 0;
    padding-right: 0;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 80%;
    float:right;
}
</style>
</head>
<body onload="startTime()">
<div class="sticky">
    <div class="topnav">
    <a href="#contact">Logout</a>
    <a href="#news">My Account</a>
    <a class="active" href="#home">Home</a>
    </div>
    <main class="container" id="mainContainer">
    <div id="col-1"></div>
    <div id="col-2"><div id="icon">
    </main>
    <div class="welcome">
    <h3><?php echo $username ?>'s Exercise Tracker</h3>
    </div>
    <div id="txt"></div>

    <div id="mySidenav" class="sidenav">
    <a href="exercise.php" id="about">Exercise</a>
    <a href="#" id="blog">Sleep</a>
    <a href="#" id="projects">Diet</a>
    <a href="#" id="contact">Instructor</a>
    </div>
</div>
<div class="outside">
    <div class="title">
        <h2>Exercise Inputs<h2>
        <button onclick="document.getElementById('id01').style.display='block'" >Cardio</button>
        <button onclick="document.getElementById('id02').style.display='block'">Strength</button>
        <button onclick="document.getElementById('id03').style.display='block'">Flexibility</button>
    </div>
    <div class="title2">
        <h2>Medical Metrics Inputs<h2>
        <button onclick="document.getElementById('id04').style.display='block'" >BMI</button>
        <button onclick="document.getElementById('id05').style.display='block'">Weight</button>
        <button onclick="document.getElementById('id05').style.display='block'">Height</button>

    </div>
</div>
<div style="position:relative; z-index=-2;">
    <canvas id="myChart" style="max-width:600px;left:0"></canvas>
    <canvas id="myChart2" style="max-width:600px;left:0"></canvas>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Cardio Tracker</h2>
    </div>

    <div class="container">
      <label for="cal"><b>Calories Burnt</b></label>
      <input type="text" placeholder="Enter Calories" name="cal" required>
      <label for="cal"><b>Exercise Name</b></label>
      <input type="text" placeholder="Enter Calories" name="cal" required>
      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Strength Tracker</h2>

    </div>

    <div class="container">
      <label for="uname"><b>Calories Burnt</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
      <label for="cal"><b>Exercise Name</b></label>
      <input type="text" placeholder="Enter Calories" name="cal" required>
      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<div id="id03" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Flexibility Tracker</h2>

    </div>

    <div class="container">
      <label for="uname"><b>Calories Burnt</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="uname"><b>Exercise Name</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<div id="id04" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>BMI Tracker</h2>
 
    </div>

    <div class="container">
      <label for="uname"><b>New BMI</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
        
      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<div id="id05" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Weight Tracker</h2>
    </div>

    <div class="container">
      <label for="uname"><b>New Weight</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id05').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<div id="id06" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h2>Height Tracker</h2>
    </div>

    <div class="container">
      <label for="uname"><b>New Height</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <button type="submit">Submit</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
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
var xValues = ["Deadlift", "Running", "Pull-Ups"];
var yValues = [55, 49, 44];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
];

var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// var modal = document.getElementById('id02');

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }
// var modal = document.getElementById('id03');

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

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
      text: "Your Exercise History"
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
      text: "Your Overall Calories Change"
    }
  }
});
</script>
</html> 