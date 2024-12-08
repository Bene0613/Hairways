<?php
    session_start();
    include_once'./classes/database.php';
    $db = new Database("localhost", "root", "", "hairrways");
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
</head>
<style>
    h2 {
        text-align: center;
        font-size: 25px;
        font-style: italic;
        color: green;
        }


        .bottom {
            text-align: center;
        }
    .bottom_btn {
        background-color: #301934;
        color:white;
        border-radius:5px;
        padding:10px 20px;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        }

    .bottom_btn:hover {
        background-color: #a778b3;
        transform: scale(1.05);
        text-decoration: none;
        }
</style>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav>

<h2> Thank you for your order! </h2>
<div class="bottom">
    <a href="products.php" class="bottom_btn">Continue Shopping</a>
</div>
</body>
</html>