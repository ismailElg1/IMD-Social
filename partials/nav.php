<?php 
if(!isset($_SESSION)){
    session_start();
    $loggedIn = false;
}
else if($email = $_SESSION['email']){
    $loggedIn = true;
}
?>
<link rel="stylesheet" type="text/css" href="css/nav.css">
<div id="logo">
    <a href="#">Imageo</a>
</div>
<div id="nav" class="navMenu">
      <a href="index.php">Home</a>
      <a href="profile.php">Profile</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
</div>

