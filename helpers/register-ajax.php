<?php
 session_start();

include_once("../classes/db.php");

 
 if($_POST && isset($_POST)){ 
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(!empty($email) && !empty($username) && !empty($password)){
      //get user with email
      $conn = Db::getInstance();
      $stmt = $conn->prepare("select * from users where email = :email");
      $stmt -> bindValue(":email", $email);
      $stmt -> execute();
      $user = ($stmt->fetch());
     
      //check if email is taken
      if($user){
        echo "Email already taken";
      }
      //else if check if username is taken
      else{
            $tm = "@student.thomasmore.be";
            $tm2 = "@thomasmore.be";

            if(empty($email)){
               echo "Email cannot be empty.";
            }
            if(preg_match("/\b($tm|$tm2)\b/", $email) === 0){
               echo "Email should be a TM-email";
            }
   

           else{
            $stmt = $conn->prepare("select * from users where username = :username");
            $stmt -> bindValue(":username", $username);
            $stmt -> execute();
            $user = ($stmt->fetch());
            if($user){
              echo "Username already taken";
            }
            else{
              //check if username is valid
              if(preg_match("/^[a-zA-Z0-9]+$/", $username) === 0){
                echo "Username should only contain letters and numbers";
              }
              else{
                //password must be at least 6 characters long
                if(strlen($password) < 5){
                  echo "Passwords must be longer than 6 characters.";
                }
                else{
                  //register the user
                  $conn = Db::getInstance();
                  $stmt = $conn->prepare("insert into users (email, username, password) values (:email, :username, :password)");
                  $stmt -> bindValue(":email", $email);
                  $stmt -> bindValue(":username", $username);
                  $stmt -> bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
                  $stmt -> execute();
                
                  $_SESSION['email'] = $email;
                  echo "success";
                }
              }
            }
           }
      }
 }
 else{
    echo "Please fill in all fields";
  }
  
 }
