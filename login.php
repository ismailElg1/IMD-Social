<?php
// include_once("bootstrap.php");


if(!empty($_POST)){
    try{
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
  
    }
    //catch
    catch(Exception $e){
        $error = $e->getMessage();
    }
  }

  
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login - Imageo</title>
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>
    <?php if(!empty($error)){ ?>
                <div id="loginError"class="errorMessage"><?php echo $error; ?></div>
            <?php } ?>
    <div id="loginForm" class="Form">
        <form method="post" action="">
            
            <h1>Login</h1>
            <div class="form-group">
                <input class="form-input ani username" name="username" placeholder="Username" type="text" />
                <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                <input class="form-input ani password" name="password" placeholder="Password" type="password" />
                <span class="border-bottom-animation left"></span>
            </div>
            <div class="container">
                <div class="center">
                    <button class="btn" name="register" type="submit" value="Register">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="loginBtn">LOGIN</span>
                    </button>
                </div>
            </div>
            <button id="forget" name="forgetPassword">Forget password?</button>
        </form>
    </div>
</body>
</html>