<?php
include_once('../classes/db.php');
$id = $_GET['id'];
$userId = $_GET['user'];

//check session email is valid
session_start();
$email = $_SESSION['email'];
$conn = Db::getInstance();
$stmt = $conn->prepare("select * from users where email = :email");
$stmt -> bindValue(":email", $email);
$stmt -> execute();
$user = ($stmt->fetch());

//check if user is the right one that logged in
if($user['id'] == $userId){
    $stmt = $conn->prepare("delete from posts where id = :id");
    $stmt -> bindValue(":id", $id);
    $stmt -> execute();
    header("Location: ../../index.php");
}
else{
    header("Location: ../../index.php");
}


?>