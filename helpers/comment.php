<?php
    include_once("../classes/db.php");
    $error = false;
    if(!empty($_POST)&&isset($_POST)){
        session_start();
      
         $comment = $_POST['comment'];
         var_dump($comment);
         var_dump($_SESSION['email']);
         //comment is not empty and valid
            if(!empty($comment)){
                //comment is valid
                if(strlen($comment) <= 255){
                    //comment is valid
                    if(strlen($comment) >= 1){
                        //comment is valid
                        //get user from email session
                        $conn = Db::getInstance();
                        $stmt = $conn->prepare("select * from users where email = :email");
                        $stmt -> bindValue(":email", $_SESSION['email']);
                        $stmt -> execute();
                        $user = ($stmt->fetch());
                        
                        //if no errors and user exists
                        if(!$error && $user){
                           
                           
                            $stmt2 = $conn->prepare("insert into comments (comment, user_id, created_at, post_id) values (:comment, :user_id, :created_at, :post_id)");
                            $stmt2->bindValue(":comment", $comment);
                            $stmt2->bindValue(":user_id", $user['id']);
                            $stmt2->bindValue(":created_at", date("Y-m-d H:i:s"));
                            $stmt2->bindValue(":post_id", $_POST['post_id']);
                            $stmt2->execute();
                            
                            header("Location: ../projects/?id=".$_POST['post_id']);
                        }

                     
                    }

                    else{
                        $error = true;
                    }
                }
                else{
                    $error = true;
                }
            }
            else{
                $error = true;
            }
    }
    else{
        $error = true;
    }

    if($error==true){
        header("Location: ../index.php");
    }

?>
