<?php 
session_start();
//if ($_SESSION['usertype'] != 'admin') {
    //header("Location: login.php");
    //exit();
//}
//


include_once'./classes/database.php';
$db = new Database("localhost", "root", "", "hairrways");
$categories = $db ->query("SELECT id, name FROM categories");

if (isset($_POST['add_prd'])) {
    $pname = $_POST['product_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $image_tmp_name = $image['tmp_name'];
    $image_folder = 'images/1x/' . basename($image['name']);  
    $category_id = $_POST['category'];

    // Prepare the SQL query
    $stmt = $db->prepare("INSERT INTO products (name, description, price, image_url, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $pname, $desc, $price, $image_folder, $category_id); 

    if($stmt->execute()) {
        move_uploaded_file($image_tmp_name, $image_folder);
        $display_message= "Product inserted successfully";
    } else {
        $display_message= "There is some error inserting product";
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
            flex-direction:column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 500px;
            border: 1px solid #D8BFD8;
        }

        .around h3 {
            color: #301934;
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
        }

        .submit_btn {
            width: 100%;
            padding: 10px;
            background-color: #301934;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .around input, .around textarea, .around select {
            width: 100%;
            padding:10px;
            margin-bottom: 15px;
            border: 1px solid #D8BFD8;
            border-radius: 8px;
            font-size: 1rem;
        }

        .submit_btn:hover {
            background-color: #A77BB3;
        }
        .display_msg {
            position: relative;
            background-color: #28a745;
            color:white;
            padding: 35px;
            font-size: 16px;
            text-align: center;µ
            margin: 20px auto;
            width: 80%;
            border-radius: 5px;
        }

        .display_msg i {
            position:absolute;
            top: 5px;
            right: 10px;
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

    <div class="around">
        <?php if (isset($display_message)) : ?>
        <div class="display_msg">
            <span><?php echo htmlspecialchars($display_message); ?></span>
            <i class="fas fa-times" onClick="this.parentElement.style.display = 'none';"></i>
        </div>
        <?php endif; ?>
        
        <section>
            <h3 class="heading">Add a new product</h3>
            <form action=""class="prd+" method="POST" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Enter product name" class="inputField" required>

                <input type="text" name="description" placeholder="Enter product description" class="inputField" required>

                <input type="number" name="price" min="0" step="0.01" class="inputField" placeholder="Enter product price" class="inputField"  required>

                <input type="file" name="image" required accept="images/png, images/jpg, images/webp" class="inputField">

                <select class="category" name="category" placeholder="Category" required>
                    <?php while ($cat = $categories -> fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                   <?php endwhile; ?> 
                </select>

                <input type="submit" name="add_prd" class="submit_btn" value="Add product" >
            </form>
        </section>
    </div>
    <footer>©2024 all rights reserved</footer>
</body>
</html> "