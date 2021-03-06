<?php
    //include 'user.php';
    // session_start();
    // $username = $_SESSION['login'];
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
/* canvas {
    padding-left: 0;
    padding-right: 0;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 80%;
    float:right;
} */
canvas {
    padding-left: 0;
    padding-right: 0;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 100%;
    float:right;
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
/* Bordered form */
form {
  border: 3px solid #f1f1f1;
  width: 40%;
  margin: -15% 10%;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: red;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
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

.flip-card {
  background-color: transparent;
  width: 300px;
  height: 300px;
  border: none;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
  font-family: 'Quicksand', cursive;

}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #8AACF0;
  color: black;
  border-radius:100px;
}

/* Style the back side */
.flip-card-back {
  background-color: #8AACF0;
  color: white;
  transform: rotateY(180deg);
  border-radius:100px;

}

.recipes{
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 42px;
}
.textbox{
  text-align: center;
  float:left;
}
table{
  width:50%;
  float:right;
  overflow-y:auto;
}
</style>
</head>
<body onload="start()">
<input type="hidden" id="custId" name="custId" value=<?php echo $result->userID?>> 

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
  <h3>Diet Tracker for <?php echo $result->Fname." ".$result->Lname ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="exercise.php" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="instructor.php" id="contact">Instructor</a>
</div>

<div style="position:relative;">
    <canvas id="myChart" style="max-width:300px;left:0;margin-top:-100px"></canvas>
    <!-- <canvas id="myChart2" style="max-width:500px;left:0"></canvas> -->
    <table>
      <?php 
    
      $url = "http://localhost:5000/api.php?getMyFoodID=".$id;
      
      $client = curl_init($url);
      curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
      $response = curl_exec($client);
      $resultF = json_decode($response);
      ?>
  <tr>
    <th>Food Item</th>
    <th>Calories</th>
    <th>Sugar</th>
    <th>Fat</th>
    <th>Protein</th>
    <th>Carbohydrates</th>
    <th>Sodium</th>

  </tr>
  <?php 
  if($resultF==null){
    $size=0;
  }else{
    $size = count($resultF->food);
  }
  for($i=0;$i<$size;$i++){ ?>
  <tr>
    <td><?php echo $resultF->food[$i]?></td>
    <td><?php echo $resultF->cal[$i]?></td>
    <td><?php echo $resultF->sugar[$i]?></td>
    <td><?php echo $resultF->fat[$i]?></td>
    <td><?php echo $resultF->protein[$i]?></td>
    <td><?php echo $resultF->carbs[$i]?></td>
    <td><?php echo $resultF->sodium[$i]?></td>
  </tr>
  <?php } ?>
</table>
</div>
<div class = "textbox">
  <h1>Daily Calorie Intake:</h1>
  <?php
    $url = "http://localhost:5000/api.php?dietCalID=".$id;
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $cal_result = json_decode($response);
    echo "<h1>";
    if($cal_result->cal!=null){
      echo $cal_result->cal;
    }else{
      echo "0";
    }
    echo " cal</h1>";
    ?>
</div>
<!-- Button to open the modal login form -->
<button onclick="document.getElementById('id01').style.display='block'">Add Breakfast</button>
<button onclick="document.getElementById('id01').style.display='block'">Add Lunch</button>
<button onclick="document.getElementById('id01').style.display='block'">Add Dinner</button>
<!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>
  <!-- Modal Content -->
  <form id = "food" class="modal-content animate" method = "POST" action = "">
  <input type="hidden" id="uid" name="uid" value=<?php echo $result->userID?>> 
    <div class="modal-container">
      Food Item:<input type="text" placeholder="ex: Pizza" name="food_item" required><br>
      Calories(cal):<input type="text" placeholder="ex: 250" name="cals" required><br>
      Sugar(g): <input type="text" placeholder="ex: 76" name="sugar" required><br>
      Fat(g): <input type="text" placeholder="ex: 34" name="fat" required><br>
      Protien(g): <input type="text" placeholder="ex: 30" name="protein" required><br>
      Carbohydrates(g): <input type="text" placeholder="ex: 30" name="carbs" required><br>
      Sodium(g): <input type="text" placeholder="ex: 30" name="sodium" required><br>
      <button type="submit">Add Food Item</button>
    </div>
  </form>
</div>

<!-- <div style="width:90%;margin:0 auto;">
  <canvas id = myChart style="width:100px;left:0"></canvas>
  <canvas id = myChart2 style="width:100px;left:0"></canvas>
</div> -->
<h1>Recipes:</h1>
<div class = "recipes">
  <?php
    $url = "http://localhost:5000/api.php?dietID=".$id;
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $card_result = json_decode($response);

    for($i=0;$i<count($card_result->cal);$i++){
    echo "<div class='flip-card'>
      <div class='flip-card-inner'>
        <div class='flip-card-front'>
          <h1>".$card_result->name[$i]."</h1>
          <img src='https://thumbs.dreamstime.com/b/healthy-vegetarian-cooking-ingredients-tasty-pumpkin-dishes-recipes-bowls-tomato-sauces-spinach-sliced-onion-pumpkin-seeds-103694189.jpg' style='width:280px;height:150px;border-radius:20px'>
        </div>
        <div class='flip-card-back'>
          <h1>".$card_result->steps[$i]."</h1>
          <h1>".$card_result->ing[$i]."</h1>
          <h1>".$card_result->cal[$i]." cal</h1>
        </div>
      </div>
    </div>";
    }
  ?>
</div>
</body>
<script>
var id = document.getElementById("custId").value;

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
$("#food").on("submit", function(e) {
 
 var dataString = $(this).serialize();
  console.log(dataString);
  $.post('http://localhost:5000/api.php', dataString, function(response) {
    // Log the response to the console
    console.log("Response: "+response);
    location.reload();
});
 e.preventDefault();
});

function pieChart(){
  $.ajax({
          url: "http://localhost:5000/api.php?dietInfoID="+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res);
              //json = res;
              //alert(res);
              var data = [res].map(function(e) {
                    return e.fat;
              });;
               var data2 = [res].map(function(e) {
                    return e.protein;
              });;
              data.push(data2[0]);
              data2 = [res].map(function(e) {
                    return e.carbs;
              });;
              data.push(data2[0]);
              data2 = [res].map(function(e) {
                    return e.sugar;
              });;
              data.push(data2[0]);
              data2 = [res].map(function(e) {
                    return e.sodium;
              });;
              data.push(data2[0]);
              var xValues = ["Fat", "Protien", "Carbohydrates", "Sugar", "Sodium"];
              //var yValues = [55, 49, 44, 24, 60];
              var barColors = [
                "#b91d47",
                "#00aba9",
                "#2b5797",
                "#e8c3b9",
                '#FF0000' 
              ];

              new Chart("myChart", {
                type: "doughnut",
                data: {
                  labels: xValues,
                  datasets: [{
                    backgroundColor: barColors,
                    data: data
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: "Your Diet History"
                  }
                }
              });     
        }
  });
}

function start(){
  pieChart();
  startTime();
}
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
