<?php
session_start();
include_once'./classes/database.php';

$error_msg = "";
$success_msg ="";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $nowPW = $_POST['nowPw'];
    $newPW = $_POST['newPw'];
    $surePW = $_POST['surePw'];

    if(empty($nowPW) || empty($newPW) || empty($surePW)) {
        $error_msg = "Please fill in everything";
    } elseif ($newPW !== $surePW) {
        $error_msg = "The passwords aren't the same";
    } else {
        $db = new Database("localhost", "root", "", "hairrways");
        
        $stmt = $db->prepare("SELECT password FROM clients WHERE id= ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if(password_verify($nowPW, $row['password'])) {
                $update_stmt = $db->prepare("UPDATE clients SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $_SESSION['user_id']);
                $update_stmt->execute();

                if($update_stmt->affected_rows>0) {
                    session_destroy();
                    header("Location: login.php?message-Password updated successfully. Please log in again");
                    exit();
                } else {
                    $error_msg = "Failed to update password";
                }
            }else {
                    $error_msg = "Current password is incorrect";
            }
        }else {
            $error_msg = "User not found";
        }

            $stmt->close();
            $db->close();
            }
        }
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

.message {
    text-align:center;
    margin-top:15px;
    color:#ff0000;
}

.succes {
    color: green;
}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="euhm">
        <form action="" method="POST">
        <?php if (!empty($error_msg)): ?>
            <div class="message"><?= $error_msg ?></div>
        <?php elseif (!empty($success_msg)): ?>
            <div class="message success"><?= $success_msg ?></div>
        <?php endif; ?>
        
        <h2>Password change</h2>
        <div class="text">
            <input type="password" name="nowPw" placeholder="Current password" required>
        </div>
        <div class="text">    
            <input type="password" name="newPw" placeholder="New password" required>
            </div>
        <div class="text">
            <input type="password" name="surePw" placeholder="Confirm new password" required>
        </div>    
            <button type="submit">Change password</button>
        </form>
        </div>
    </div>
</body>
</html>
