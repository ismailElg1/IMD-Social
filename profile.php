<?php
//check if the user is logged in
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    //get the user name
    $username = $_SESSION['username'];
    include_once(__DIR__ . "/partials/nav.php");
    include_once(__DIR__ . "/classes/Db.php");

    if(isset($_POST['btnChangeUsername'])){
        $conn = Db::getInstance();
        $change_username = $_POST['change_username'];
        $stmt = $conn->prepare("UPDATE users SET username = :change_username WHERE username = :username");
        $stmt->bindValue(":change_username", $change_username);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $_SESSION['username'] = $change_username;
        header("Location: profile.php");
    }

    if(isset($_POST['btnChangeImage'])){
        $conn = Db::getInstance();
        $image = $_FILES['image']['name'];
        $target_file = "upload/" . basename($_FILES["image"]["name"]);
        $image_path = "upload/".$image;
    
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");

        if( in_array($imageFileType,$extensions_arr) ){
            if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){   
                $conn->prepare("UPDATE users SET imgpath = '$image_path' WHERE username = '$username'")->execute();
            }
        }
    }

    if(isset($_POST['btnChangeEmail2'])){
        $conn = Db::getInstance();
        $email2 = $_POST['email2'];
        $stmt = $conn->prepare("UPDATE users SET email2 = :email2 WHERE username = :username");
        $stmt->bindValue(":email2", $email2);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
    }

    if(isset($_POST['btnBio'])){
        $conn = Db::getInstance();
        $bio = $_POST['bio'];
        $stmt = $conn->prepare("UPDATE users SET bio = :bio WHERE username = :username");
        $stmt->bindValue(":bio", $bio);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
    }

    if(isset($_POST['btnEducation'])){
        $conn = Db::getInstance();
        $education = $_POST['education'];
        $stmt = $conn->prepare("UPDATE users SET education = :education WHERE username = :username");
        $stmt->bindValue(":education", $education);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
    }

    if(isset($_POST['btnDelete'])){
        include_once(__DIR__ . "/classes/User.php");
        $user = new User();
        $user->setUsername($username);
        $user->deleteUser($username);
        header("Location: login.php");
    }
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
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="profile-pic">
            <label class="-label" for="file">
                <span class="fa fa-camera"></span>
                <span id="changeImageText">Change Profile Picture</span>
            </label>
            <input type="file" name="image" id="file" onchange="loadFile(event)"/>
            <input type="submit" name="btnChangeImage" value="Save">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/No_avatar.png" id="output" width="200" />
        </div>

        <div id="changeForm" class="Form">
            <div class="form-group">
                    <label for="change_username">Change Username</label>
                    <input name="change_username" id="change_username" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
                    <input type="submit" name="btnChangeUsername" value="Save">
            </div>
            <div class="form-group">
                    <label for="email2">Change Second Email</label>
                    <input name="email2" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
                    <input type="submit" name="btnChangeEmail2" value="Save">
            </div>
            <div class="form-group">
                    <label for="bio">Change Bio</label>
                    <input name="bio" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
                    <input type="submit" name="btnBio" value="Save">
            </div>
            <div class="form-group">
                    <label for="education">Change Education</label>
                    <input name="education" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
                    <input type="submit" name="btnEducation" value="Save">
            </div>
        </div>
        <div>
            <div class="container">
                <div class="center">
                    <button class="btn" name="btnDelete" type="submit" value="Delete profile">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="registerBtn">DELETE PROFILE</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script src="js/profile.js"></script>
</body>
</html>