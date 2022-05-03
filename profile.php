<?php
//check if the user is logged in
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    //get the user name
    $username = $_SESSION['username'];
    include_once(__DIR__ . "/partials/nav.php");
}
else{
    //send user to login page
    header("Location: login.php");
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <title>Profile - <?php echo $username ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div>
        <div class="profile-pic">
            <label class="-label" for="file">
            <span class="fa fa-camera"></span>
                <span id="changeImageText">Change Image</span>
            </label>
            <input id="file" type="file" onchange="loadFile(event)"/>
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/No_avatar.png" id="output" width="200" />
        </div>
    </div>
    <div id="changeForm" class="Form">
        <div class="form-group">
                <input class="form-input ani email" placeholder="Change username" type="text"/>
                <span class="border-bottom-animation left"></span>
        </div>
        <div class="form-group">
                <input class="form-input ani email" placeholder="Add 2nd email" type="text"/>
                <span class="border-bottom-animation left"></span>
        </div>
        <div class="form-group">
                <input class="form-input ani email" placeholder="Bio" type="text"/>
                <span class="border-bottom-animation left"></span>
        </div>
        <div class="form-group">
                <input class="form-input ani email" placeholder="Education" type="text"/>
                <span class="border-bottom-animation left"></span>
        </div>
        <div class="form-group">
                <input class="form-input ani email" placeholder="Links" type="text"/>
                <span class="border-bottom-animation left"></span>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="center">
                <button class="btn" name="register" type="submit" value="Register">
                    <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                    </svg>
                    <span id="registerBtn">SAVE CHANGES</span>
                </button>
            </div>
        </div>
        <div class="container">
            <div class="center">
                <button class="btn" name="register" type="submit" value="Register">
                    <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                    </svg>
                    <span id="registerBtn">DELETE PROFILE</span>
                </button>
            </div>
        </div>
    </div>
    



    <script src="js/profile.js"></script>
</body>
</html>