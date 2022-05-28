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
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" href="./css/gallery.css">
</head>
<body>
    <?php include_once(__DIR__ . "/partials/nav.php")?>

    <!-- print out all the posts -->
    <div class="container">
    <?php
   
    
    $posts = Post::getAll();
    foreach($posts as $post){
        //get post id
        $postId = $post['id'];
        echo "<a class='projectName' href='projects/?id=$postId'>";
        echo "<div class='post'>";
        echo "<h1>".$post['title']."</h1>";
        echo "<img src='./upload/".$post['image']."' alt='".$post['title']."'>";
        echo "</div>";
        echo "</a>";
    }
    ?>
    </div>
    
   <form action="./gallery.php" method="POST">

<div class="container">
<div class="center">
<button class="btn" name="addPost" type="submit">
                    <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                    <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                    </svg>
<span id="addPost">Add post</span>
</button>
</div>
</div>


</form>  
   <a href="logout.php">Log out?</a>
</body>
</html>