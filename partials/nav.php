<?php 
if(!isset($_SESSION)){
    session_start();
    $loggedIn = false;
}
else if($username = $_SESSION['username']){
    $loggedIn = true;
}
?>
<div id="logo">
    <a href="#">Imageo</a>
</div>
<div id="nav" class="navMenu">
      <a href="#">Home</a>
      <a href="#">Profile</a>
      <a href="../login.php">Login</a>
      <a href="../register.php">Register</a>
</div>

