<?php
 session_start();

include_once("../classes/db.php");
include_once("../classes/user.php");

//check if post
if($_POST || isset($_POST) || !empty($_POST)){ 
    $error = "";

    //check if password is in post
    if(isset($_POST['password'])||isset($_POST['passwordConfirm']) && !empty($_POST['password'])&&!empty($_POST['passwordConfirm'])){
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        

        $conn = Db::getInstance();
        $stmt = $conn->prepare("select * from users where email = :email");
        $stmt -> bindValue(":email", $_SESSION['email']);
        $stmt -> execute();
        $user = ($stmt->fetch());

        if(password_verify($password, $user['password'])){
     
            if($password == $confirmPassword){
                $user = new User();
               
                $user->setEmail($_SESSION['email']);
                $user->deleteUser();
               
            }
            else{
                $error = "Passwords don't match";
            }
        }
        else{
            $error = "Password is wrong";
        }
     
}
else{
    //print error
    $error = "Please fill in all fields";
}
}
     
 
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./fonts.php")?>
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  

    <title>Confirm Deletion</title>
</head>
<body>
 
          
            
        
    <div class="Form">
       
     
        <form action="" method="post">
        <?php if(isset($error)){
            echo '<div class="errorMessage">'. $error .'</div>';
            if(!empty($error)){
                echo "<script>document.querySelector('.errorMessage').style.display = 'block';</script>";
            }
            else{
                echo "<script>document.querySelector('.errorMessage').style.display = 'none';</script>";
            }
            } ?>
            <h1>Confirm Deletion</h1>
       
        
            <div class="form-group">
                <input class="form-input ani password" name="password" placeholder="Password" type="password" required/>
                <span class="border-bottom-animation left"></span>
            </div>
             
            <div class="form-group">
                <input class="form-input ani password" name="confirmPassword" placeholder="Confirm Password" type="password" required/>
                <span class="border-bottom-animation left"></span>
            </div>

            <div class="container">
                <div class="center">
                    <button class="btn" name="register" type="submit" value="Register">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="loginBtn">DELETE</span>
                    </button>
                </div>
            </div>


     
</form>
<br><br>
<a href="../profile.php" class="back-link">&laquo; Go back</a>
</div>
</body>
</html>