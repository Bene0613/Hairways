<?php
        session_start();
        include_once'./classes/database.php';
        $db = new Database("localhost", "root", "", "hairrways");

        $error_message = "";

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email) && !empty($password)) {
                $stmt = $db->prepare("SELECT * FROM clients WHERE email = ?");
                if($stmt) {
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                    if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['usertype'] = $row['usertype'];

                    if ($row["usertype"] == "user") {
                        header("Location: index.php");
                        exit();
                    } elseif ($row["usertype"] == "admin") {
                        header("Location: newprod.php");
                        exit();
                    }
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "No user found with that email.";
            }
            $stmt->close();
        } else {
            $error_message = "Failed to prepare the query.";
        }
    } else {
        $error_message = "Please fill in both email and password.";
    }
}

$db-> close();
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
  border: 1px solid #301934;
  padding: 10px;
  box-shadow: 5px 10px #301934;
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
                    <p>Forgotten password? <a href="newPW.php">Change it </a></p>
                    <p>Don't have an account? <a href="sign.php">Sign Up </a></p>
                </div>
            </form>
        </div>
</div>
<footer>©2024 all rights reserved</footer>
</body>
</html>
