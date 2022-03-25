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
 font-size: 1em;
 color: #666;
 background:none;
 border:none;
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
 font-size: 1em;
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
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5px auto; /* 15% from the top and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  /* Position it in the top right corner outside of the modal */
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

/* Close button on hover */
.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}

.userInfo{
    background-color:rgb(0,0,0,0.1);
    border-radius:10px;
    width:28%;
    margin:0 auto;
    padding-left:8%;
}

button {
    display:inline-block;
    background-color:#424bf5;
    padding:15px;
    border-radius:10px;
    color:white;
    border:none;
    margin:5px;
}

button:hover{
    background-color:#c842f5;
}

.insideI{
    border-radius:10px;
    width:50%;
    height:50%;
    background-color:rgb(255,255,255,1);
    margin:0 auto;
    overflow-y:auto;
    border:none;
}

form{
  background-color:blue;
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

<div class="userInfo">
  <h2>Change Instructor Information</h2>
<?php
  for($j=0;$j<5;$j++){
    echo "<button onclick=\"document.getElementById('id01').style.display='block'\">View Instructor".$j."</button>
    <!-- The Modal -->
    <div id='id01' class='modal'>
    <span onclick=\"document.getElementById('id01').style.display='none'\"
    class=\"close\" title=\"Close Modal\">&times;</span>
    <div class='insideI'>
        <h1>Instructor".$j."</h1>
    <form class='modal-content animate' action='/action_page.php'>

    <div class='container' style='border-color:blue;'>
      <label for='uname'><b>Username</b></label>
      <input type='text' placeholder='Enter Username' name='uname' required>

      <label for='psw'><b>Password</b></label>
      <input type='password' placeholder='Enter Password' name='psw' required>

      <button type='submit'>Update</button>
    </div>
  </form>
    </div>
    </div>";
   // <!-- Modal Content -->
  }
?>
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


</script>
</html> 
