<?php
session_start();

//if ($_SESSION['usertype'] != 'admin') {
    //header("Location: login.php");
    //exit();
//}
//


$conn = new mysqli("localhost","root","","hairrways");
$categories = $conn ->query("SELECT id, name FROM categories");

if(!empty($_POST)){
    $pname = $_POST['product_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $imageurl = $_POST['url'];
    $category_id = $_POST['category'];

    $query = $conn ->query("INSERT INTO products (name, description, price, image_url, category_id) VALUES ('".$conn->real_escape_string($pname)."','".$conn->real_escape_string($desc)."','".$conn->real_escape_string($price)."','".$conn->real_escape_string($imageurl)."','".$conn->real_escape_string($category_id)."')");

    if($query) {
        header("Location: product.php");
        exit();
    } else {
        echo "error";
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
         body{
            font-family: 'Nunito';
            padding: 0;
            margin: 0;
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

        .h1 {
            text-align: center;
            font-size: 2rem;
            color: #301934;
            margin-top: 20px;
        }

        .around {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .wrap {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 400px;
            border: 1px solid #D8BFD8;
        }

        .wrap h2 {
            color: #301934;
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
        }

        .wrap button {
            width: 100%;
            padding: 10px;
            background-color: #301934;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .wrap input, .wrap textarea, .wrap select {
            width: 100%;
            padding:10px;
            margin-bottom: 15px;
            border: 1px solid #D8BFD8;
            border-radius: 8px;
            font-size: 1rem;
        }

        .wrap button:hover {
            background-color: #A77BB3;
        }

        footer {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="nbar">
        <div class="one">
           <ul>
                <li><a href="product.php">SHOP</a></li>
                <li><a href="bestseller.php">BESTSELLERS</a></li>
                <li><a href="sets.php">SETS</a></li>
                <li><a href="about.php">ABOUT US</a></li>
            </ul>  
        </div>
        <a href="#" class="logo">
            <img src="images/1x/Middel 1.png" alt="logo">
        </a> 
        <div class="two">
            <ul>
                <li><a href="acc.html"><i class="fa-regular fa-user" style="color: #050505;"></i></a></li>
                <li><a href="cart.html"><i class="fa-regular fa-cart-shopping" style="color: #050505;"></i></a></li>
            </ul>
        </div>
    </nav>

    <h1>Add a new product</h1>
    <div class="around">
        <div class="wrap">
            <h2>Product details</h2>
            <form action="" method="POST">
            <label for="product_name"> Name of the product</label>
                <input type="text" id="prd_name" name="product_name" required>

                <label for="description"> Description of the product</label>
                <input type="text" id="desc" name="description" required>

                <label for="price"> Price (unity) </label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>

                <label for="image"> Add an image </label>
                <input type="url" id="url" name="url" required>

                <label for="category"> Category</label>
                <select id="category" name="category" required>
                    <?php while ($cat = $categories -> fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                   <?php endwhile; ?> 
                </select>

                <button type="submit"> Add</button>
            </form>
        </div>
    </div>
    <footer>©2024 all rights reserved</footer>
</body>
</html>
