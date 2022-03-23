<?php 
//remove cookie

session_start();
session_destroy();
header("Location: login.php");

?>