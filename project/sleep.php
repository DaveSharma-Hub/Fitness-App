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


    $url = "http://localhost:5000/api.php?sleepScheduleUID=".$id;
	
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result2 = json_decode($response);

    $url = "http://localhost:5000/api.php?sleepRecommendedUID=".$id;
	
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result3 = json_decode($response);

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
    width: 100%;
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

.sleepPlan{
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
<input type="hidden" id="custId" name="custId" value=<?php echo $result->userID?>> 
<body onload="start()">
<!-- <body onload="pieChartInfo()"> -->

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
  <h3>Sleep Tracker for <?php echo $result->Fname." ".$result->Lname ?></h3>
</div>
<div id="txt"></div>

<div id="mySidenav" class="sidenav">
  <a href="exercise.php" id="about">Exercise</a>
  <a href="sleep.php" id="blog">Sleep</a>
  <a href="diet.php" id="projects">Diet</a>
  <a href="instructor.php" id="contact">Instructor</a>
</div>
<div style="width:90%;margin:0 auto;">
    <canvas id="weeklySleepChart" style="max-width:700px;left:0"></canvas>
    <canvas id="hoursSlept" style="max-width:350px;left:0"></canvas>
</div>
<div class = "sleep"> 
    <form id="sleep" action="" method="post">
      <input type="hidden" id="Sleepuid" name="Sleepuid" value=<?php echo $result->userID?>> 
        <label for="sleeptime"><b>Sleep Time</b></label>
        <input type="time" placeholder="Enter Sleep Time" name="sleeptime" required>

        <label for="wakeuptime"><b>Wakeup Time</b></label>
        <input type="time" placeholder="Enter Wakeup Time" name="wakeuptime" required>

        <button type="submit">Submit</button>
    </form>
</div>

<div class = "notes">
    <form id ="notes" action="" method="post">
    <input type="hidden" id="Noteuid" name="Noteuid" value=<?php echo $result->userID?>> 
        <label for="textNotes"><b>Notes</b></label>
        <input type="textarea" placeholder="Enter Notes Here..." name="textNotes" required>
        <button type="submit">Save</button>
    </form>
</div>
<div class="notes">
<table>
  <h3>My Notes</h3>
  <tr>
    <th>Date</th>
    <th>Notes</th>
  </tr>
  <?php
    $url = "http://localhost:5000/api.php?getMyNotes=".$id;
    
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $resultN = json_decode($response);
    for($i=0;$i<count($resultN->notes);$i++){ ?>
  
  <tr>
    <td><?php if($resultN==null){echo 0;}else{echo $resultN->date[$i];}?></td>
    <td><?php if($resultN==null){echo 0;}else{echo $resultN->notes[$i];}?></td>
  </tr>
    <?php } ?>
    </table>
<br><br><br>
</div>
<table>
  <tr>
    <th>Legend</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Sunday</th>

  </tr>
  <tr>
    <td>Recommended Hours</td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
    <td><?php if($result3==null){echo 0;}else{echo $result3->time;}?></td>
  </tr>
  <tr>
    <td>Hours Slept</td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->mon;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->tue;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->wed;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->thur;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->fri;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->sat;} ?></td>
    <td><?php if($result2==null){echo 0;}else{echo $result2->sun;} ?></td>
  </tr>
</table>

<div class = "sleepPlan">
  <?php
    $url = "http://localhost:5000/api.php?getMySleepPlan=".$id;
    
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $resultS = json_decode($response);
    // echo $resultS->recSleepTime;
    // echo $resultS->recWakeupTime;
    // echo $resultS->recHours;
  ?>
  <h3>Instructor Recomendation:</h3>
  <h3>Try to sleep at <?php if($resultS==null){echo "none";}else{echo $resultS->recSleepTime;} ?> and wakeup at <?php if($resultS==null){echo "none";}else{echo $resultS->recWakeupTime;} ?>. Aim for at least <?php if($resultS==null){echo "none";}else{echo $resultS->recHours;} ?> hours of sleep.</h3>
</div>



<script>
var id = document.getElementById("custId").value;

    var xDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday"];
    
    // new Chart("weeklySleepChart", {
    // type: "line",
    // data: {
    //     labels: xDays,
    //     datasets: [{
    //     data: [4, 6, 6, 5, 5.5, 8, 9],
    //     borderColor: "red",
    //     fill: false
    //     }]
    // },
    // options: {
    //     legend: {display: false},
    //     title: {
    //         display: true,
    //         text: "Weekly Sleep Hours"
    //     }
    // }
    // });
    

  function scatterChartInfo(){
  
  //   const xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onload = function() {
  //     json=this.responseText;
  //   }
  // xmlhttp.open("GET", "http://localhost:5000/api.php?sleepUID="+id);
  // xmlhttp.send();
    $.ajax({
          url: "http://localhost:5000/api.php?sleepScheduleUID="+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res);
              //json = res;
              //alert(res);
              var data = [res].map(function(e) {
                    if(res==null){return [0];}
                    else{return e.mon;}
              });;
               data2 = [res].map(function(e) {
                  if(res==null){return [0];}  
                  else{return e.tue;}
              });;
              data.push(data2[0]);
               data2 = [res].map(function(e) {
                if(res==null){return [0];}    
                else{return e.wed;}
              });;
              data.push(data2[0]);
               data2 = [res].map(function(e) {
                if(res==null){return [0];}    
                else{return e.thur;}
              });;
              data.push(data2[0]);
               data2 = [res].map(function(e) {
                if(res==null){return [0];}    
                else{return e.fri;}
              });;
              data.push(data2[0]);
               data2 = [res].map(function(e) {
                if(res==null){return [0];}   
                else{return e.sat;}
              });;
              data.push(data2[0]);
               data2 = [res].map(function(e) {
                if(res==null){return [0];}    
                else{return e.sun;}
              });;
              data.push(data2[0]);
              // var arr = [4, 6, 6, 5, 5.5, 8, 9];
              //console.log(arr);
              // console.log(data);
              new Chart("weeklySleepChart", {
                type: "line",
                data: {
                    labels: xDays,
                    datasets: [{
                    data: data,//[4, 6, 6, 5, 5.5, 8, 9],
                    borderColor: "red",
                    fill: false
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Weekly Sleep Hours"
                    },
                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true,
                                    steps: 9,
                                    stepValue: 1,
                                    max: 10
                                }
                            }]
                    } 
                }
              });
              
          }
      });
}
// var json;//={"hours_slept":7};

// console.log(data);
function pieChartInfo(){
  
  //   const xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onload = function() {
  //     json=this.responseText;
  //   }
  // xmlhttp.open("GET", "http://localhost:5000/api.php?sleepUID="+id);
  // xmlhttp.send();
    $.ajax({
          url: "http://localhost:5000/api.php?sleepUID="+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              console.log(res);
              //json = res;
              //alert(res);
              var data = [res].map(function(e) {
                     if(res==null){
                       return [0];
                     }else{
                        return e.hours_slept;
                     }
              });;
              var xHours = ["Percentage of Hours Slept", "Percentage of Remaining Hours for Recommended"];
              var yValues = [data/8*100,(1-(data/8))*100];
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
          }
      });
}
// var data;
//  console.log(json);
// if(json!=null){
//     data = [json].map(function(e) {
//     return e.hours_slept;
//   });;
// }
// if(data==null){
//   data = 0;
// }
    // var xHours = ["Percentage of Hours Slept", "Percentage of Remaining Hours for Recommended"];
    // var yValues = [data/8*100,(1-(data/8))*100];
    // var barColors = [
    //     "#b91d47",
    //     "#00aba9",
    // ];
    // new Chart("hoursSlept", {
    // type: "doughnut",
    // data: {
    //     labels: xHours,
    //     datasets: [{
    //     data: yValues,
    //     backgroundColor: barColors
    //     }]
    // },
    // options: {
    //     title: {
    //         display: true,
    //         text: "Percentage of Hours Slept in a Day"
    //     }
    // }
    // });

function start() {
  pieChartInfo();
  scatterChartInfo();
  startTime();
}
$("#sleep").on("submit", function(e) {
 
 var dataString = $(this).serialize();
  console.log(dataString);
  $.post('http://localhost:5000/api.php', dataString, function(response) {
    // Log the response to the console
    console.log("Response: "+response);
    location.reload();
});
 e.preventDefault();
});
$("#notes").on("submit", function(e) {
 
 var dataString = $(this).serialize();
  console.log(dataString);
  $.post('http://localhost:5000/api.php', dataString, function(response) {
    // Log the response to the console
    console.log("Response: "+response);
    location.reload();
});
 e.preventDefault();
});
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
