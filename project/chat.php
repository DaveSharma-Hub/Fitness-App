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
.chat{
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    width:90%;
    margin:0 auto;
    height:50vh;
    overflow-y:auto;
}
.left{
    float:left;
    font-family: 'Quicksand', cursive;
    font-size: 1.5em;
    width:25%;
    background-color:green;
    padding:5px;
    border-radius:10px;
    color:white;
}
.right{
    float:right;
    font-family: 'Quicksand', cursive;
    font-size: 1.5em;
    width:25%;
    background-color:blue;
    padding:5px;
    border-radius:10px;
    color:white;
}
.leftMe{
    float:left;
    font-family: 'Quicksand', cursive;
    font-size: 1em;
    width:auto;
    background-color:green;
    padding:5px;
    border-radius:10px;
    color:white;
}
.rightThem{
    float:right;
    font-family: 'Quicksand', cursive;
    font-size: 1em;
    width:auto;
    background-color:blue;
    padding:5px;
    border-radius:10px;
    color:white;
}

.message{
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    width:90%;
    margin:0 auto;
    height:10vh;
}

.message input[type=text] {
  width: 85%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
  font-family:'Quicksand',cursive;
  font-size:1.5rem;
  font-weight:bold;
}
button {
  background-color: red;
  color: white;
  padding: 20px 10px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
  border-radius: 10px;
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
  <h3>Welcome <?php echo $username ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="exercise.php" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="instructor.php" id="contact">Instructor</a>
</div>

<div class="chat">
    <?php
        // for($i=0;$i<10;$i++){
        //     if($i==){
        //         echo "<div class='left'>Hello</div>";
        //     }else{

        //     }
        // }
        
    ?>
    <div class="leftMe">You</div><div class="left">Hello</div><br><br>
    <div class="rightThem">Instructor</div><div class="right">Hi</div><br><br>
    <div class="leftMe">You</div><div class="left">I messaged you the workout plan.</div><br><br>
    <div class="rightThem">Instructor</div><div class="right">Thanks</div><br><br>
    <div class="leftMe">You</div><div class="left">Did it suit you?</div><br><br>
    <div class="rightThem">Instructor</div><div class="right">Very much so</div><br><br>
    <div class="leftMe">You</div><div class="left">Have a great rest of your day</div><br><br>
    <div class="rightThem">Instructor</div><div class="right">You as well</div><br><br>

</div>
<div class="message">
    <form>
        <input type="text">
        <button type="submit">Message</button>
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
