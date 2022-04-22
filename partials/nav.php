<?php 
if(!isset($_SESSION)){
    session_start();
    $loggedIn = false;
}
else if($username = $_SESSION['username']){
    $loggedIn = true;
}
?>
<link rel="stylesheet" type="text/css" href="../css/nav.css">
 <nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../profile.php">Profile</a></li>
       <?php 
        if(isset($loggedIn)){
            if(!$loggedIn){
                echo '<li><a href="../register.php">Register</a></li>
                <li><a href="../login.php">Login</a></li>';
            }
            else{
              
            }
            
        }
       ?>
    </ul>
</nav>
