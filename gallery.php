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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/button.css">
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <style>
      
        
    </style>
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>

  
    <form class="gallery_upload Form" action="helpers/gallery-upload.php" method="POST" enctype="multipart/form-data">
    <h1>Gallery</h1>
   <div class="form-group">
       <input class="form-input ani" type="text" name="galleryTitle" placeholder="Project title...">
       <span class="border-bottom-animation left"></span>
    </div>
            
    <div class="form-group"><input class="form-input ani" type="text" name="galleryDesc" placeholder="Project description..."><span class="border-bottom-animation left"></span></div>
    <div class="form-group"><input class="form-input ani" type="file" name="images[]" value='' multiple><span class="border-bottom-animation left"></span></div>
   
    <div class="container">
                <div class="center">
                    <button class="btn" name="submit" type="submit" value="Upload">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="loginBtn">Upload</span>
                    </button>
                </div>
            </div>
    </form>

    <!-- go back link -->
    <a href="index.php">Go back</a>


</body>
</html>