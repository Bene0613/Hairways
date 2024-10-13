<?php
    function canIn($username, $password) {
        if ($username === "jenaam@shop.com" && $password ==="12345isnotsecure") {
            return true;
        } else {
            return false;
        }
    }

    if (!empty($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(canIn($username, $password)) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = true;
        }

    }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrap">
        <div class ="euhm">
            <form action="" method="POST">
            <h2>Log in</h2>
                <div class= "text">
                    <input type ="text" name="username" placeholder= "Username">
                </div>
                <div class= "text">
                    <input type ="password" name="password" placeholder= "Password">
                </div>
                <button type = "submit">Log in</button>
                <div class="alert <?php echo $error ? '': 'hidden'; ?>">
                ops, we couldn't log you in. Let’s try again!
                </div>
                <div class="more">
                    <p>Don't have an account? <a href="#">Sign Up </a></p>
                </div>
            </form>
        </div>
</div>
</body>
</html>