<?php
// Include your database connection file
include "../settings/connection.php";
include "../action/login_process.php";
session_start();
echo $login_failed;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800;900&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <title>Login</title>
</head>
<body>
<header class="header">
        <div class="logo">
            <img src="../assests/images/4.svg" alt="Seed for Change logo" style="width: 50px; height: auto; margin-left: 20px;">
        </div>
        <div class="cta">
        <button onclick="scrollToGetStarted()">Get Started</button>
        </div>
</header>

<div class="login-container">
    <div class="login-box">
    <form action="../action/login_process.php" method="POST">
        <h1 style="margin-bottom: 0px;">Welcome Back</h1>
        <p style="margin-bottom: 50px; margin-top: 10px;">Login To Your Account</p>
        <input type="email" id="email" name="email" placeholder="Email" style="width: 300px; height: 30px; font-size: 15px" required ><br><br>

        <input type="password" id="password" name="password" placeholder="Password" style="width: 300px; height: 30px; font-size: 15px" required><br><br>
    
        <button name="login" type="submit" id="loginButton">Login</button>
    </form>
    </div>
    <div class="login-text">
    <h3 style="font-size: 20px;">New to Seed For Change?</h3>
    <p style="font-size: 20px;">Seed For Change connects skilled professionals with nonprofit organizations, facilitating the enhancement of their capabilities and the fulfillment of their objectives.</p>
    <br><button id="registerButton"><a href="../login/register.php">Register here</a></button>
    </div>
</div>


<footer>
   
  <div>
    <a href="#">Privacy</a>
    <a href="#">Contact Us</a>
    <a href="../view/homepage.php">About Us</a>
  </div>

  <img src="../assests/images/2.svg" alt="Profile Picture" style="width: 200px; text-align:center; margin-right: 1200px; ">
</footer>

<?php
// Display SweetAlert2 alert if login failed
if (isset($_SESSION["login_failed"])) {
  // Do something with $login_failed
  $login_failed = $_SESSION["login_failed"];
  if ($login_failed==1) {
    echo '<script>';
    echo 'Swal.fire({';
    echo 'timer: 2000,';
    echo 'icon: "error",';
    echo 'title: "Login Failed",';
    echo 'text: "Incorrect email or password. Please try again.",';
    echo '});';
    echo '</script>';
}
  // You might want to unset the session variable after using it
  unset($_SESSION["login_failed"]);
}

 
?>
    

</body>

</html>
