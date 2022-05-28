<?php
include_once("../classes/post.php");
include_once("../classes/user.php");

$post = Post::getById($_GET['id']);


$user = User::getUserById($post['user_id']);


echo "<div class='container'>";
echo "<h1>".$post['title']."</h1>";
echo "<img src='../upload/".$post['image']."' alt='".$post['title']."'>";
echo "<span class='desc'>".$post['description']."</span>";
echo "<span>Created on: ".$post['created_at']." & Made By: ".$user['username'];"</span>";

//get every tag individually
$tags = explode(",", $post['tags']);
//loop through the tags and display them
echo "<div class='tagBox'>";
echo "<h3>Tags:</h3>";
foreach($tags as $tag){
    echo "<span class='tag'>$tag</span>";
}
echo "</div>";
echo "<a href='../index.php'>Go back</a>";
echo "</div>";




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/projects.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <?php include_once("./../helpers/fonts.php")?>
</head>
<body>
    
</body>
</html>