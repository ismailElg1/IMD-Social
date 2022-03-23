<?php
// include_once("bootstrap.php");


if(!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];
   
    include_once(__DIR__ . "/classes/User.php");
    $user = new User();
    $user->setUsername($username);
    $user->setPassword($password);
    
    if($user->canLogin()){
     session_start();
     $_SESSION['username'] = $username;
     header('Location: index.php');
    }
    else{
     $error = true;
    }
  }

  
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Imageo</title>
</head>
<body>
    <div id="loginForm">
        <form method="post" action="">
            <input name="username" placeholder="Username" type="text" required autofocus />
            <input name="password" placeholder="Password" type="password" required />
            <input type="submit" value="Login" />
            <button name="forgetPassword">Forget password?</button>
        </form>
    </div>
</body>
</html>