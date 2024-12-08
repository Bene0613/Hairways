<?php
    if(!empty($_POST)){
       $fname = $_POST['firstname'];
       $lname = $_POST['lastname'];
       $email = $_POST['email'];
       $password = $_POST['password'];
       $addr = $_POST['address'];
       $options = [
        'cost' => 14,
    ];
       $hash = password_hash($password, PASSWORD_DEFAULT, $options);
       $conn = new mysqli("localhost","root","","hairrways");
       $statement = $conn->prepare('INSERT INTO clients (first_name,last_name, email, password, address) VALUES (?,?,?,?,?)');
       $statement-> bind_param('sssss', $fname, $lname, $email, $hash, $addr);
       if($statement->execute()){
            header('Location: index.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
    body {
    font-family: 'Nunito';
    padding: 0;
    margin: 0;    
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 50px;
    height: 100vh;
    background: linear-gradient(to bottom, #632676,#bea3c6, #D8BFD8, #F5F5F5); 
}

.wrap {
  background-color: white;
  width: 350px;
  height: 380px;
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

.alert.hidden {
font-size: smaller;
display: none;
}

.alert {
 color: #301934 ;
 font-style: italic;
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
            <h2>Welcome</h2>
                <div class= "text">
                    <input type ="text" name="firstname" placeholder= "First name">
                </div>
                <div class= "text">
                    <input type ="text" name="lastname" placeholder= "Last name">
                </div>
                <div class= "text">
                    <input type ="text" name="email" placeholder= "Email">
                </div>
                <div class= "text">
                    <input type ="password" name="password" placeholder= "Password">
                </div>
                <div class= "text">
                    <input type ="address" name="address" placeholder= "Full address">
                </div>
                <button type = "submit">Sign up</button>
                <div class="alert <?php echo $error ? '': 'hidden'; ?>">
                There is already an account linked to this email. Let’s try again!
                </div>
                <div class="more">
                    <p>Already have an account? <a href="login.php">Log in </a></p>
                </div>
            </form>
        </div>
</div>
<footer>©2024 all rights reserved</footer>
</body>
</html>
