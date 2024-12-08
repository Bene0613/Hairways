<?php
    $conn = new mysqli("localhost","root","","hairrways");
    $products = $conn->query("SELECT name, price, image_url, id FROM products");
 
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

        .gg {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .filter {
            width: 200px;
            padding: 20px;
            height: 100px;
            border: 1px solid #D8BFD8;
            border-radius: 8px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            font-size: 1rem;
            color: #301934
        }

        .filter label {
            display:block;
            font-weight: bold;
            margin-bottom:22px;
        }

        .articles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1200px;
            width: 100%;
            padding:20px;
        }

        .prd {
            text-align: center;
            border: 1px solid #D8BFD8;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
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
            margin-bottom: 10px;
        }

        .prd h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #301934;
        }

        .prd h3 {
            font-size: 18px;
            color: #9f4fa3;
            font-weight: bold;
            margin-bottom: 10px;
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
           <img src="<?php echo $prod['image_url']; ?>" alt="<?php echo $prod['name']; ?>">
            <h2><?php echo $prod['name']; ?></h2>
            <h3>€<?php echo $prod['price']; ?></h3>
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
</body>
</html>