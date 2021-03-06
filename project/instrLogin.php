<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Simple Login</title>
</head>
<style>
     /* Bordered form */

body{
  background-color: rgb(158, 160, 160);
}

#over img {
  margin:auto;
  display: block;
  width:200px;
  border-radius: 10px;
  padding-top:100px;
}
form {
  border-radius: 10px;
  background-color: white;
  border: 3px solid #f1f1f1;
  margin: 0 auto;
  width:30%;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 10px;
  font-family:Arial, Helvetica, sans-serif;
}

/* Set a style for all buttons */
button {
  background-color: #0704aa;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 10px;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
  background-color:#7d7be4 ;
}

/* Extra style for the cancel button (red) */
.signupbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
.signupbtn:hover{
  background-color: #ff7b00;
}
/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
.adminbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #36b8f4;
}
.userbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #36b8f4;
}
/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .signupbtn {
    width: 100%;
  }
} 
</style>
<body>
  <div id="over" style="width:100%; height:100%">
    <img src="index.png">
  </div>
  <form id="regForm" action="instr.php" method="post">
      
      <div class="container">
        <h2>Instructor Login</h2>  

          <label for="uname">Username</label>
          <input type="text" placeholder="Enter Username" name="uname" required>
      
          <label for="psw">Password</label>
          <input type="password" placeholder="Enter Password" name="psw" required>
      
          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>
      
        <div class="container" style="background-color:#f1f1f1">
          <button type="button" class="signupbtn" onclick="location.href='signup.html';">Sign Up</button>
          <button type="button" class="adminbtn" onclick="location.href='adminLogin.html';">Admin Login</button>
          <button type="button" class="userbtn" onclick="location.href='login.php';">User Login</button>
        </div>
      </form> 
</body>
</html>