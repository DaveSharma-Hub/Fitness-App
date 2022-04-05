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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
<body onload="start()">
<input type="hidden" id="iid" name="iid" value=<?php echo $id?>> 

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
  <h3>Welcome <?php echo $result->Fname." ".$result->Lname  ?></h3>
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
        $url = "http://localhost:5000/api.php?getMySubscriberIID=".$id;
	
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result2 = json_decode($response);

            for($i=0;$i<count($result2->UID);$i++){
                echo "<button onclick=\"document.getElementById('".$i."').style.display='block'\">".$result2->FName[$i]." ".$result2->LName[$i]."</button>
                <!-- The Modal -->
                <div id='".$i."' class='modal'>
                <span onclick=\"document.getElementById('".$i."').style.display='none'\"
                class=\"close\" title=\"Close Modal\" >&times;</span>
                <!-- Modal Content -->
                <form class='modal-content animate'>
                <input type='hidden' id='custId' name='custId' value=".$result2->UID[$i]."> 

                    <div class='chat' id='chat'>
                    
                    </div>
                    <div class='message'>
                        <form id='chatMsg'>
                        <input type='hidden' id='sender' name='sender' value='0'> 
                        <input type='hidden' id='custIId' name='custIID' value=".$id."> 
                        <input type='hidden' id='custId' name='custId' value=".$result2->UID[$i]."> 
                            <input type='text' id='textField' name='textField' required>
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
  var iid = document.getElementById("iid").value;
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

function getData(){
      $.ajax({
          type: 'GET',
          url: 'asynchronous.php?id='+id+'&IID='+iid,
          success: function(data){
            //console.log(data);
              $('#chat').html(data);
                      var newscrollHeight = $("#chat")[0].scrollHeight - 20; //Scroll height after the request
                      //if(newscrollHeight > oldscrollHeight){
                       $("#chat").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                  // }   
              }
          });
      }
getData();

setInterval(function () {
    getData(); 
}, 1000);  // it will refresh your data every 1 sec


$("#chatMsg").on("submit", function(e) {
 var dataString = $(this).serialize();
  console.log(dataString);
  $.post('http://localhost:5000/api.php', dataString, function(response) {
    // Log the response to the console
    //document.getElementById("textField").value = "";
     console.log("Response: "+response);
    //location.reload();
});
 e.preventDefault();
});

function start(){
  getData();
}
</script>
</html> 