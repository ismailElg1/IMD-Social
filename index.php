<?php
include_once("bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");

if(Security::onlyLoggedInUsers()){
    echo "You are logged in";
   
}
else{
    var_dump($_SESSION['user']);
    echo $_SESSION['user'];
    echo "You are not logged in";
    header("Location: login.php");
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imageo</title>
</head>
<body>
   Welcome to the page
</body>
</html>