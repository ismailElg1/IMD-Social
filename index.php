<?php
include_once("bootstrap.php");
include_once(__DIR__ . "/helpers/Security.php");
include_once("./classes/post.php");
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
   Welcome to the page
   <form action="" method="POST" enctype="multipart/form-data">
    <a href="./gallery.php">Add post</a>
   </form>  
    <!-- print out all the posts -->
    <?php
   
    
    $posts = Post::getAll();
    foreach($posts as $post){
        echo "<div class='post'>";
        echo "<h1>".$post['title']."</h1>";
        echo "<p>".$post['description']."</p>";
        echo "<img src='./upload/".$post['image']."' alt='".$post['title']."'>";
        echo "</div>";
    }
    ?>
   <a href="logout.php">Log out?</a>
</body>
</html>