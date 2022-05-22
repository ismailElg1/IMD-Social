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
    <link rel="stylesheet" href="./css/gallery.css">
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>
   Welcome to the page
   <form action="" method="POST" enctype="multipart/form-data">
    <a href="./gallery.php">Add post</a>
   </form>  
    <!-- print out all the posts -->
    <div class="container">
    <?php
   
    
    $posts = Post::getAll();
    foreach($posts as $post){
        //get post id
        $postId = $post['id'];
        echo "<a href='projects/?id=$postId'>";
        echo "<div class='post'>";
        echo "<h1>".$post['title']."</h1>";
        echo "<img src='./upload/".$post['image']."' alt='".$post['title']."'>";
        echo "</div>";
        echo "</a>";
    }
    ?>
    </div>
   <a href="logout.php">Log out?</a>
</body>
</html>