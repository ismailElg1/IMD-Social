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
            $_SESSION['username'] = $user->getUsername();
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
    <?php include_once(__DIR__ . "/helpers/fonts.php")?>
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Register - Imageo</title>
</head>

<body>
    
    <?php include_once(__DIR__ . "/partials/nav.php")?>
            <?php if(isset($error)): ?>
                <div class="errorMessage"><?php echo $error; ?></div>
            <?php endif; ?>
    <div id="registerForm" class="Form">
            
        <form method="post" action=>
            
            <h1>Register</h1>
            <div class="form-group">
                <input class="form-input ani email" name="email" placeholder="Email" type="email" required autofocus/>
                <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                <input class="form-input ani username" name="username" placeholder="Username" type="username" required autofocus />
                <span class="border-bottom-animation left"></span>
            </div>
            <div class="form-group">
                <input class="form-input ani password" name="password" placeholder="Password" type="password" required/>
                <span class="border-bottom-animation left"></span>
            </div>

            <div class="container">
                <div class="center">
                    <button class="btn" name="register" type="submit" value="Register">
                        <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
                        <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
                        </svg>
                        <span id="registerBtn">SIGN UP</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>