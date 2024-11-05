<?php
    $conn = new mysqli("localhost","root","","Hairways");
    $products = $conn->query("SELECT name, price, image_url FROM products");
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products</title>
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

        .articles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 20px;
            margin: 0 auto;
        }

        .prd {
            text-align: center;
            border: 1px solid #D8BFD8;
            padding: 10px;
            border-radius: 8px;
        }

        .prd:hover {
            border: 3px solid #D8BFD8;
            cursor: pointer;
        }

        .prd img {
            max-width: 100%;
            height: auto;
            border-radius: 5px
        }

        .prd h2 {
            color: #301934;
            font-size: 1.2em;
            margin: 10px 0;
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

    <h1>Our product list</h1>
    <div class="articles">
        <?php foreach ($products as $prod): ?>
           <div class="prd">
           <img src="<?php echo $prod['image_url']; ?>" alt="<?php echo $prod['name']; ?>">
            <h2><?php echo $prod['name']; ?></h2>
            <h3><?php echo $prod['price']; ?></h3>
           </div>
        <?php endforeach;?>
    </div>
</body>
</html>