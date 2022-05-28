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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/projects.css">

    <?php include_once("./../helpers/fonts.php")?>
</head>
<body>
    <!-- input field to add comments to this post -->
    <form class="Form" action="../helpers/comment.php" method="post">
    <div class="commentBox">
        <div class="center">
            <form action="../classes/comment.php" method="POST">
                <div class="form-group"><input class="form-input ani" type="text" name="comment" placeholder="Add a comment..."><span class="border-bottom-animation left"></span></div>
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" name="addComment">Add comment</button>
            </form>
        </div>
</form>
    <div class="comments">
        <?php
        //select all from comments where post_id is equal to the post id
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = :post_id");
        $stmt->bindValue(":post_id", $post['id']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        //loop through all the comments and display them
        foreach($result as $comment){
            $user = User::getUserById($comment['user_id']);
            echo "<div class='comment'>";
            echo "<div class='comment-header'>";
            echo "<span class='comment-username'>".$user['username']."</span>";
            echo "<span class='comment-date'>".$comment['created_at']."</span>";
            echo "</div>";
            echo "<div class='comment-body'>";
            echo "<p>".$comment['comment']."</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>