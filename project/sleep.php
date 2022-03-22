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
.sleep form {
  margin:0 auto;
  width:12%;
  font-family: 'Quicksand', cursive;
}

.notes form{
  margin:0 auto;
  width:50%;
  font-family: 'Quicksand', cursive;
}

input[type=textarea] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-family: 'Quicksand', cursive;
}

input[type=time] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-family: 'Quicksand', cursive;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
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

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
  <a href="#" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="#" id="contact">Instructor</a>
</div>

<div class = "sleep"> 
    <form action="action_page.php" method="post">
        <label for="sleeptime"><b>Sleep Time</b></label>
        <input type="time" placeholder="Enter Sleep Time" name="sleeptime" required>

        <label for="wakeuptime"><b>Wakeup Time</b></label>
        <input type="time" placeholder="Enter Wakeup Time" name="wakeuptime" required>

        <button type="submit">Submit</button>
    </form>
</div>

<div class = "notes">
    <form action="action_page.php" method="post">
        <label for="textNotes"><b>Notes</b></label>
        <input type="textarea" placeholder="Enter Notes Here..." name="textNotes" required>
        <button type="submit">Save</button>
    </form>
</div>

<table>
  <tr>
    <th>Legend</th>
    <th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
  </tr>
  <tr>
    <td>Recommended Hours</td>
    <td>8</td>
    <td>8</td>
    <td>8</td>
    <td>8</td>
    <td>8</td>
    <td>8</td>
    <td>8</td>
  </tr>
  <tr>
    <td>Hours Slept</td>
    <td>4</td>
    <td>6</td>
    <td>6</td>
    <td>5</td>
    <td>5.5</td>
    <td>8</td>
    <td>9</td>
  </tr>
</table>

<div style="margin:0 13%;">
    <canvas id="weeklySleepChart" style="max-width:500px;left:0"></canvas>
    <canvas id="hoursSlept" style="max-width:500px;left:0"></canvas>
</div>

<script>

    var xDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    new Chart("weeklySleepChart", {
    type: "line",
    data: {
        labels: xDays,
        datasets: [{
        data: [4, 6, 6, 5, 5.5, 8, 9],
        borderColor: "red",
        fill: false
        }]
    },
    options: {
        legend: {display: false},
        title: {
            display: true,
            text: "Weekly Sleep Hours"
        }
    }
    });

    var xHours = ["Percentage of Hours Slept", "Percentage of Remaining Hours for Recommended"];
    var yValues = [5/8*100, (1-5/8)*100];
    var barColors = [
        "#b91d47",
        "#00aba9",
    ];
    new Chart("hoursSlept", {
    type: "doughnut",
    data: {
        labels: xHours,
        datasets: [{
        data: yValues,
        backgroundColor: barColors
        }]
    },
    options: {
        title: {
            display: true,
            text: "Percentage of Hours Slept in a Day"
        }
    }
    });

</script>

</html> 