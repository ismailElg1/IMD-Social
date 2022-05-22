<?php
include_once("../classes/post.php");

$post = Post::getById($_GET['id']);
echo "<h1>".$post['title']."</h1>";
echo "<img src='../upload/".$post['image']."' alt='".$post['title']."'>";
echo "<p>".$post['description']."</p>";
echo "<p>".$post['created_at']."</p>";


echo "<a href='../index.php'>Go back</a>";


?>