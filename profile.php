<?php
//check if the user is logged in
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    //get the user name
    $email = $_SESSION['email'];

    include_once(__DIR__ . "/partials/nav.php");
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){
        if(!empty($_POST['current_password'])){
            $user = new User();
            $user->setEmail($email);
            $conn = Db::getInstance();
            $currentPassword = $_POST['current_password'];
            $stmt = $conn->prepare("SELECT password FROM users WHERE email = :email");
            $stmt -> bindValue(":email", $email);
            $stmt -> execute();
        }
        
        if(!empty($_FILES['image'])){
            $conn = Db::getInstance();
            $image = $_FILES['image']['name'];
            $target_file = "upload/" . basename($_FILES["image"]["name"]);
            $image_path = "upload/".$image;
        
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");

            if( in_array($imageFileType,$extensions_arr) ){
                if(move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){   
                    $conn->prepare("UPDATE users SET imgpath = '$image_path' WHERE email = '$email'")->execute();
                }
            }
        }
        if(!empty($_POST['change_username'])){
            $user = new User();
            $user->setEmail($email);
            $user->setUsername($_POST['change_username']);
            $user->registerUsername(); 
        }
        if(!empty($_POST['email2'])){
            $user = new User();
            $user->setEmail($email);
            $user->setEmail2($_POST['email2']);
            $user->registerEmail2();
        }
        if(isset($_POST['bio'])){
            $user = new User();
            $user->setEmail($email);
            $user->setBio($_POST['bio']);
            $user->registerBio();
        }
    
        if(isset($_POST['education'])){
            $user = new User();
            $user->setEmail($email);
            $user->setEducation($_POST['education']);
            $user->registerEducation();
        }

        if(isset($_POST['delete'])){
            $user = new User();
            $user->setEmail($email);
            $user->deleteUser($email);
            header("Location: login.php");
        }

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
    <title>Profile</title>
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
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/No_avatar.png" id="output" width="200" />
        </div>

        <div id="changeForm" class="Form">
            <div class="form-group">
                    <label for="change_username">Change Username</label>
                    <input name="change_username" id="change_username" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                    <label for="email2">Change Second Email</label>
                    <input name="email2" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                    <label for="bio">Change Bio</label>
                    <input name="bio" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                    <label for="education">Change Education</label>
                    <input name="education" class="form-input ani email" placeholder="" type="text"/>
                    <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input name="current_password" class="form-input ani email" placeholder="" type="password"/>
                    <span class="border-bottom-animation left"></span>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="center">
                    <button class="btn" name="save" type="submit" value="Delete profile">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="registerBtn">Save Changes</span>
                    </button>
                </div>
            </div>
            <div class="container">
                <div class="center">
                    <button class="btn" name="delete" type="submit" value="Delete profile">
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