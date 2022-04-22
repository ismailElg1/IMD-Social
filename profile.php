<?php
//check if the user is logged in
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    //get the user name
    $username = $_SESSION['username'];
}
else{
    //send user to login page
    header("Location: login.php");
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo $username ?></title>
</head>
<body>
 
    <h1>Profile</h1>
    <p>Welcome <?php echo $username ?></p>

    <form method="post" action="">
       Name: <input name="username" placeholder="<?php echo $username ?>" type="text" required autofocus />
      
    </form>  
    <br>
</body>
</html>