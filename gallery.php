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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <style>
        .gallery_upload input::placeholder{
            color: black;
        }
        .gallery_upload{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>
    Gallery
  
    <form class="gallery_upload" action="helpers/gallery-upload.php" method="POST" enctype="multipart/form-data">
    <p><input type="text" name="galleryTitle" placeholder="Project title..."></p>
    <p><input type="text" name="galleryDesc" placeholder="Project description..."></p>
    <p><input type="file" name="images[]" value='' multiple></p>
    <p><input type="submit" name="submit" value="Upload"></p>
    </form>

    <!-- go back link -->
    <a href="index.php">Go back</a>


</body>
</html>