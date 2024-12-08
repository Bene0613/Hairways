<?php
    session_start();

    include_once'./classes/database.php';
    include_once'./classes/Prod.php';

    $db = new Database("localhost", "root", "", "hairrways");
    $prod = new Prod($db);


    if  (isset($_SESSION['usertype'])&& $_SESSION['usertype'] == 'admin' && isset($_GET['delete_id'])) {

        $prod->deleteProduct($_GET['delete_id']);
        header("Location: product.php");
        exit();
    }

    $products = $prod->getAllProducts();
 
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hairways - Products</title>
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


        h1 {
            text-align: center;
            font-size: 2rem;
            color: #301934;
            margin-top: 20px;
        }

        .admin-panel {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .admin-panel h2 {
            text-align: center;
            color: #301934;
            margin-bottom: 20px;
        }

        .add-product-btn {
            background-color:#301934;
            color:white;
            padding:10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            display: block;
            text-align: center;
            font-size: 1rem;
        }

        .add-product-btn:hover {
            background-color: #A778B3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #301934;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .product-actions {
            display:flex;
            gap: 10px;
        }

        .product-actions a {
            color: #301934;
        }

        .product-action a:hover {
            color: #A778B3;
        }

        .gg {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter {
            width: 200px;
            padding: 20px;
            border: 1px solid #D8BFD8;
            border-radius: 8px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .filter select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #D8BFD8;
            background-color: #f8f8f8;
        }

        .articles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
            padding:20px;
        }

        .prd {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .prd:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px #D8BFD8;
            cursor: pointer;
        }

        .prd img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .prd h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #301934;
            font-weight: bold;
        }

        .prd h3 {
            font-size: 18px;
            color: #9f4fa3;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .subscribe {
            display:flex;
            align-items:center;
            border: 1px solid #ccc;
            border-radius: 50px;
            overflow:hidden;
            width: 400px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .subscribe input {
            flex: 1;
            border: none;
            outline: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 50px 0 0 50px;
        }

        .subscribe button {
            border: none;
            outline: none;
            background-color: #301934;
            color: #fff;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 0 50px 50px 0;
            transition: background-color 0.3s;
        }

        .subscribe button:hover {
            background-color: #A778B3;
        }

        .entirety {
            display: flex;
            flex-direction: row;
            text-align: center;
            width: 100%;
        }

        .part1, .part2 {
            flex: 1;
        }

        .part1 {
            background-color: #dfdfdf;
            padding: 20px;
        }

        .part2 {
            background-color: #f8f8f8;
            display:flex;
            flex-direction: row;
            gap: 45px;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .euh {
            text-align: left;
        }

        .euh {
            font-size: smaller;
            font-weight: 400;
        }

        footer p {
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav>

    <h1>Our product list</h1>
    <?php if (isset($_SESSION['usertype'])&& $_SESSION['usertype'] == 'admin'): ?>
        <h2 style="font-style: italic;">Admin Panel</h2>
        <a href="newprod.php">Add New Product</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $prod): ?>
                    <tr>
                        <td><?= htmlspecialchars($prod['name']); ?></td>
                        <td><?= htmlspecialchars($prod['description']); ?></td>
                        <td>$<?= number_format($prod['price'], 2); ?></td>
                        <td>
                            <a href="edit.php?id=<?= $prod['id']; ?>">Edit</a> | 
                            <a href="product.php?delete_id=<?= $prod['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>            
   <div class= "gg">
        <div class="filter">
             <label for="category">Filter by Category</label>
             <select id="cat" name="category">
                <option value="all">All</option>
                <option value="wash">Washing</option>
                <option value="treat">Treatment</option>
                <option value="style">Styling</option>
                <option value="finish">Finish</option>
            </select>   
        </div>
        <div class="articles">
        <?php foreach ($products as $prod): ?>
            <a href="detail.php?id=<?php echo htmlspecialchars($prod['id']); ?>" style="text-decoration: none; color: inherit;">
           <div class="prd">
           <img src="<?php echo htmlspecialchars  ($prod['image_url']); ?>" alt="<?php echo $prod['name']; ?>">
            <h2><?php echo htmlspecialchars ($prod['name']); ?></h2>
            <h3>€<?php echo htmlspecialchars ($prod['price']); ?></h3>
           </div>
        <?php endforeach;?>
        </div>
   </div> 
   <footer>
    <div class = "entirety">
        <div class="part1">
            <h2>Keep up with the new products on the webshop!</h2>
            <p>Receive from us tips, sales, and other interesting info once a week in your e-mailbox.</p>
            <form class= "subscribe">
                <input type = "email" name="email" placeholder="Enter your email">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="part2">
            <div class="euh">
                <h2>Contact</h2>
                <h4>Overview</h4>
                <h4>Business account</h4>
                <h4>Account</h4>
                <h4>Contact</h4>
            </div>
            <div class="euh">
                <h2>Service</h2>
                <h4>Garantee</h4>
                <h4>Newsletters & Sale codes</h4>
                <h4>Cookie overview</h4>
                <h4>Vacancy</h4>
            </div>
            <div class="euh">
                <h2>Service</h2>
                <h4>Garantee</h4>
                <h4>Newsletters & Sale codes</h4>
                <h4>Cookie overview</h4>
                <h4>Vacancy</h4>
            </div>
        </div>
    </div>
    <p>©2024 all rights reserved</p>
   </footer>
   <?php endif; ?>
</body>
</html>