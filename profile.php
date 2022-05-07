<?php
//check if the user is logged in
include_once(__DIR__ . "/helpers/Security.php");
if(Security::onlyLoggedInUsers()){
    //get the user name
    $username = $_SESSION['username'];
    include_once(__DIR__ . "/partials/nav.php");
    include_once(__DIR__ . "/classes/Db.php");
    $conn = Db::getInstance();

    if(!empty($_POST['save'])){
        $image = $_POST['file'];
        $target_dir = "/upload";
        $target_file = $target_dir . basename($_POST["file"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        try{
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Upload file
                if(move_uploaded_file($_POST['file'],$target_dir.$image)){
                    // Insert record
                    echo "gelukt";
                }
            }
        }
        catch(Throwable $error){
            $error = $error->getMessage();
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
    <title>Profile - <?php echo $username ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form method="post">
        <div class="profile-pic">
            <label class="-label" for="file">
                <span class="fa fa-camera"></span>
                <span id="changeImageText">Change Image</span>
            </label>
            <input name="file" id="file" type="file" onchange="loadFile(event)"/>
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/No_avatar.png" id="output" width="200" />
        </div>

        <div id="changeForm" class="Form">
            <div class="form-group">
                    <label for="change_username">Change username</label>
                    <input name="change_username" id="change_username" class="form-input ani email" placeholder="<?php echo $username ?>" type="text"/>
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
                    <button class="btn" name="save" type="submit" value="Save changes">
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