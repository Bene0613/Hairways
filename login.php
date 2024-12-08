<?php
        $conn = new mysqli("localhost","root","","hairrways");

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email) && !empty($password)) {
                $email= $conn -> real_escape_string($email);
                $sql="SELECT *FROM clients WHERE email= '$email'";
                $result=$conn->query($sql);

                if($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if (password_verify($password, $row['password'])) { 
                        if ($row["usertype"] == "user") {                       
                            header("Location: index.php");  
                            exit();

                        } elseif($row["usertype"] == "admin") {
                            header("Location: newprod.php"); 
                            exit();
                        }
                    } else {
                        echo "Incorrect password.";
                    }
                } else {
                    echo "No user found with that email.";
                }
            } else {
                echo "Please fill in both email and password.";
            }
        }
        $conn -> close();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 50px;
    height: 100vh;
    background: linear-gradient(to bottom, #632676,#bea3c6, #D8BFD8, #F5F5F5); /* From left to right */
}

.wrap {
  background-color: white;
  width: 350px;
  height: 300px;
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px #D8BFD8;
  border-radius: 25px;
  padding: 20px;
}

.euhm {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

h2 {
 text-align: center;
}

.text input {
 width: 200px;
 background-color: #F5F5F5;
 border: none;
 border-bottom: 2px solid black;
 margin-bottom: 10px;
 padding: 10px;
}

button {
 width: 200px;
 border-radius: 45px;
 height:30px;
 margin-bottom: 20px;
 margin-top:20px;
}

button:hover {
 background-color: #D8BFD8;
}

.more {
 font-size: smaller;
 text-align:center;
}
    </style>
</head>
<body>
    <div class="wrap">
        <div class ="euhm">
            <form action="" method="POST">
            <h2>Log in</h2>
                <div class= "text">
                    <input type ="text" name="email" placeholder= "Email">
                </div>
                <div class= "text">
                    <input type ="password" name="password" placeholder= "Password">
                </div>
                <button type = "submit">Log in</button>
                <div class="more">
                    <p>Don't have an account? <a href="sign.php">Sign Up </a></p>
                </div>
            </form>
        </div>
</div>
<footer>©2024 all rights reserved</footer>
</body>
</html>