<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Hairways</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>

        body{
            font-family: 'Nunito';
        }

        .nbar {
           display: flex;
           justify-content: space-between;
           align-items: center;
           padding: 10px 20px;
           background-color: #f8f8f8; 
        }

        .one ul, .two ul {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .one a, .two a {
            text-decoration: none;
            color: #050505;
        }

        .nbar a:hover {
            text-decoration: underline;
            text-decoration-color: #A77BB3;
        }

        .logo img {
            width: 50px;
        }

        .banner {
            position: relative;
            color: white;
        }

        .banner img {
            width: 100%;
            height:auto;
        }

        .ban_text {
            position: absolute;
            top: 50%;
            left: 20px;
            padding: 20px;
            border-radius: 10px;
            transform: translateY(-50%)
        }

        .ban_text h1 {
            font-size: 70px;
        }

        button {
            background-color: #9F4FA3;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        button:hover {
            background-color:#DB92B8;
        }
    </style>
</head>
<body>
    <nav class="nbar">
        <div class="one">
           <ul>
                <li><a href="shop.html">SHOP</a></li>
                <li><a href="bestseller.html">BESTSELLERS</a></li>
                <li><a href="sets.html">SETS</a></li>
                <li><a href="about.html">ABOUT US</a></li>
            </ul>  
        </div>
        <a href="#" class="logo">
            <img src="images/1x/Middel 1.png" alt="logo"></a>        
        <div class="two">
            <ul>
                <i class="fa-solid fa-magnifying-glass" style="color: #050505;"></i>
                <li><a href="acc.html"><i class="fa-regular fa-user" style="color: #050505;"></i></a></li>
                <li><a href="cart.html"><i class="fa-regular fa-cart-shopping" style="color: #050505;"></i></a></li>
            </ul>
        </div>
    </nav>
    <div class="banner">
        <img src="images/1x/banner.png" alt="a banner">
        <div class="ban_text">
            <h1>HairWays</h1>
            <h2>Ways to take care of your hair.</h2>
            <button><a href="shop.html">Shop now</a></button>
        </div>
    </div>
</body>
</html>