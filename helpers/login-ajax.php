<?php
 session_start();

include_once("../classes/db.php");

 
 if($_POST && isset($_POST)){ 

  $username = $_POST['username'];
  $password = $_POST['password'];

  if(!empty($username) && !empty($password)){
    //pdo check if username and password are correct
    $conn = Db::getInstance();
    $stmt = $conn->prepare("select * from users where username = :username");
    $stmt -> bindValue(":username", $username);
    $stmt -> execute();
    $user = ($stmt->fetch());
    if(!$user){
      echo "User doesn't exist";
    }
    else if(isset($user['password'])){
      if(password_verify($password, $user['password'])){
        $_SESSION['email'] = $user['email'];
        echo "success";
      }
      else{
        echo "Password is wrong";
      }
    }
    else{
        echo "Username or password is wrong";
    }


    

  }
  else{
    echo "Please fill in all fields";
  }

 }
