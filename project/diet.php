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
    font-family: 'Quicksand', cursive;
}
.topnav {
  margin-left:5%;
  width:95%;
  overflow: hidden;
  background-color: rgb(82,16,238);
  border-radius:10px;
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
}
</style>
</head>
<body onload="startTime()">
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
  <h3>Welcome <?php echo $username ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="exercise.php" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="instructor.php" id="contact">Instructor</a>
</div>

<div style="position:relative;">
    <canvas id="myChart" style="max-width:400px;left:0"></canvas>
    <canvas id="myChart2" style="max-width:400px;left:0"></canvas>
</div>
<div class = "textbox">
  <h1>Your Daily Calorie Intake is:</h1>
  <h2>2678 cal</h2>
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
  <form class="modal-content animate">
    <div class="modal-container">
      Food Item:<input type="text" placeholder="ex: Pizza" name="psw" required><br>
      Calories(cal):<input type="text" placeholder="ex: 250" name="psw" required><br>
      Sugar(g): <input type="text" placeholder="ex: 76" name="psw" required><br>
      Fat(g): <input type="text" placeholder="ex: 34" name="psw" required><br>
      Protien(g): <input type="text" placeholder="ex: 30" name="psw" required><br>
      Carbohydrates(g): <input type="text" placeholder="ex: 30" name="psw" required><br>
      Sodium(g): <input type="text" placeholder="ex: 30" name="psw" required><br>
      <button type="submit">Add Food Item</button>
    </div>
  </form>
</div>

<div>
  <canvas id = myChart></canvas>
  <canvas id = myChart2></canvas>
</div>
<h1>Recipes:</h1>
<div class = "recipes">
  <?php
  for($i=0;$i<12;$i++){
  echo "<div class='flip-card'>
    <div class='flip-card-inner'>
      <div class='flip-card-front'>
        <h1>Vegan Pizza</h1>
        <img src='https://cdn.loveandlemons.com/wp-content/uploads/2018/09/vegan-pizza.jpg' style='width:300px;height:250px;'>
      </div>
      <div class='flip-card-back'>
        <h1>Recipe:</h1>
        <p>1.Roll out pizza dough</p>
        <p>2. Add pizza sauce evenly on dough</p>
        <p>3.Sprinkle on top cheese</p>
        <p>4.Add vegetables and toppings as desired</p>
        <p>5.Bake in oven for 30 minutes</p>
      </div>
    </div>
  </div>";
  }
  ?>
</div>
</body>
<script>
var xValues = ["Fat", "Protien", "Carbohydrates", "Sugar", "Sodium"];
var yValues = [55, 49, 44, 24, 60];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
];

new Chart("myChart", {
  type: "pie",
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
