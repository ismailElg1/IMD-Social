<?php
// include_once("bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){

}
else{

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
    <?php include_once(__DIR__ . "/partials/nav.php")?>
   Welcome to the page

   <a href="logout.php">Log out?</a>
</body>
</html>