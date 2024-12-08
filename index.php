<?php
session_start();
include_once './classes/database.php';
$db = new Database("localhost", "root", "", "hairrways");

$categories = $db->query("SELECT name FROM categories");

$bestellers = $db->query("SELECT * FROM products WHERE is_bestseller = TRUE");

$new_arrivals = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
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
        body {
            font-family: 'Nunito';
        }

        .banner {
            position: relative;
            color: white;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        .ban_text {
            position: absolute;
            top: 50%;
            left: 20px;
            padding: 20px;
            border-radius: 10px;
            transform: translateY(-50%);
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
            background-color: #DB92B8;
        }

        .extra h1 {
            text-align: center;
            font-size: 25px;
        }

        .hum {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .hum h3 {
            margin-right: 70px;
            margin-left: 70px;
            font-size: 18px;
        }

        .hum h3:hover {
            text-decoration: underline;
            text-decoration-color: #A77BB3;
        }

        .bsts {
            margin-top: 50px;
            text-align: center;
        }

        .bsts h2 {
            font-size: 30px;
            color: #301934;
            margin-bottom: 20px;
        }

        .bsts ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 0;
            list-style: none;
        }

        .bsts li {
            width: 220px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            background-color: #f8f8f8;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .bsts li:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px #D8BFD8;
        }

        .bsts img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .bsts h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #301934;
        }

        .bsts h3 {
            font-size: 18px;
            color: #9f4fa3;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .bsts li a {
            display: block;
            padding: 8px 15px;
            background-color: #9f4fa3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .subscribe {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 50px;
            overflow: hidden;
            width: 400px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            display: flex;
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

    <div class="banner">
        <img src="images/1x/banner.png" alt="a banner">
        <div class="ban_text">
            <h1>HairWays</h1>
            <h2>Ways to take care of your hair.</h2>
            <button><a href="shop.html">Shop now</a></button>
        </div>
    </div>

    <div class="extra">
        <h1>All our categories</h1>
        <div class="hum">
            <?php foreach ($categories as $cat): ?>
                <h3><?php echo $cat['name']; ?></h3>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="bsts">
        <h2>Our bestsellers</h2>
        <ul>
            <?php if ($bestellers->num_rows > 0): ?>
                <?php foreach ($bestellers as $bestpro): ?>
                    <li>
                        <img src="<?php echo $bestpro['image_url']; ?>" alt="<?php echo $bestpro['name']; ?>">
                        <h2><?php echo $bestpro['name']; ?></h2>
                        <h3><?php echo $bestpro['price']; ?></h3>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No bestsellers found</li>
            <?php endif; ?>    
        </ul>
    </div>

    <div class="bsts">
        <h2>New Arrivals</h2>
        <ul>
            <?php if ($new_arrivals->num_rows > 0): ?>
                <?php foreach ($new_arrivals as $newpro): ?>
                    <li>
                        <img src="<?php echo $newpro['image_url']; ?>" alt="<?php echo $newpro['name']; ?>">
                        <h2><?php echo $newpro['name']; ?></h2>
                        <h3><?php echo $newpro['price']; ?></h3>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No new arrivals found</li>
            <?php endif; ?>    
        </ul>
    </div>

    <footer>
        <div class="entirety">
            <div class="part1">
                <h2>Keep up with the new products on the webshop!</h2>
                <p>Receive from us tips, sales, and other interesting info once a week in your e-mailbox.</p>
                <form class="subscribe">
                    <input type="email" name="email" placeholder="Enter your email">
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
                    <h4>Guarantee</h4>
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
