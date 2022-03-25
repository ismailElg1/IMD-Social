<?php 
    if(!empty($_POST)){
        try {
            include_once(__DIR__ . "/classes/User.php");

            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword(($_POST['password']));
            $user->register();
            
            session_start();
            $_SESSION['user'] = $user->getUsername();
            header("Location: index.php");
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Imageo</title>
</head>
<body>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div id="registerForm">
        <form method="post" action=>
            <input name="email" placeholder="Email" type="email" />
            <input name="username" placeholder="Username" type="username" />
            <input name="password" placeholder="Password" type="password" />
            <input name="register" type="submit" value="Register" />
        </form>
    </div>
</body>
</html>