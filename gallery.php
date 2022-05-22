<?php
include_once("bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    if(!empty($_POST)){
        
    }
}
else{

    echo htmlspecialchars("You are not logged in");
    header("Location: login.php");
}

$user = User::getUserByEmail($_SESSION['email']);


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imageo - <?php echo htmlspecialchars($user['username']);?></title>
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>
    Gallery
  
    <form action="helpers/gallery-upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="galleryTitle" placeholder="Project title...">
    <input type="text" name="galleryDesc" placeholder="Project description...">
    <input type="file" name="images[]" value='' multiple>
    <input type="submit" name="submit" value="Upload">
    </form>


</body>
</html>