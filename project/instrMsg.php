<?php
    //include 'user.php';
    session_start();
    $username = $_SESSION['login'];
    if($username==null){
      header('Location: instrLogin.html');
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
    font-family:'Quicksand',cursive;

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
/* The Modal (background) */
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

.modal-container {
  background-color: rgba(255,255,255);
  padding: 16px;
}
/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: auto auto;
  width: 40%;
}

/* The Close Button */
.close {
  /* Position it in the top right corner outside of the modal */
  position: absolute;
  right: 25px;
  top: 0;
  color: red;
  font-size: 35px;
  font-weight: bold;
}

/* Close button on hover */
.close:hover,
.close:focus {
  cursor: pointer;
  color: red;
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

</style>
</head>
<div class="topnav">
  <a href="#">Logout</a>
  <a href="#news">My Account</a>
  <a class="active" href="instrMenu.php">Home</a>
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
  <a href="instrExercise.php" id="about">Update Exercise</a>
  <a href="instrSleep.php" id="blog">Update Sleep</a>
  <a href="instrDiet.php" id="projects">Update Diet</a>
  <a href="instrMsg.php" id="contact">Messages</a>
</div>
<div class="outer">
    <div class="chat">
        <h1>User Chat</h1>
        <h4>(Users that have subscribed to you)</h4>

        <?php
            for($i=0;$i<3;$i++){
                echo "<button onclick=\"document.getElementById('id01').style.display='block'\">User</button>
                <!-- The Modal -->
                <div id='id01' class='modal'>
                <span onclick=\"document.getElementById('id01').style.display='none'\"
                class=\"close\" title=\"Close Modal\" >&times;</span>
                <!-- Modal Content -->
                <form class='modal-content animate'>
                    <div class='chat'>
                        <div class='leftMe'>Instructor</div><div class='left'>Hello</div><br><br>
                        <div class='rightThem'>User</div><div class='right'>Hi</div><br><br>
                        <div class='leftMe'>Instructor</div><div class='left'>I messaged you the workout plan.</div><br><br>
                        <div class='rightThem'>User</div><div class='right'>Thanks</div><br><br>
                    </div>
                    <div class='message'>
                        <form>
                            <input type='text'>
                            <button type='submit'>Send</button>
                        </form>
                    </div>
                </form>
                </div>";
                }
        ?>
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

</script>
</html> 