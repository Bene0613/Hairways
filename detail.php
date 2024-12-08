<?php
session_start();

include_once('data.inc.php');
include_once'./classes/database.php';
include_once(__DIR__."/classes/comment.php");
    $productId = $_GET['product_id'];
    $allComments = comment::getAll($productId);
// Check if 'id' is passed
if (!isset($_GET['id'])) {
    exit("Product not found");
}

$id = $_GET['id']; 

$db = new Database("localhost", "root", "", "hairrways");

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$content = $result->fetch_assoc();

if (!$content) {
    if (isset($collection[$id])) {
        $content = $collection[$id];
    } else {
        exit("Product not found in both database and collection");
    }
}


if (isset($_POST['btnAdd'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price']; 
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity']; 

    $stmt = $db->prepare("INSERT INTO cart (name, price, image, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $product_name, $product_price, $product_image, $product_quantity);

    if ($stmt->execute()) {
        $display_message = "Product successfully added to cart";
    } else {
        $display_message = "Error: " . $conn->error;
    }

    $stmt->close();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<style>

        body{
            font-family: 'Nunito', sans-serif;
            padding: 0;
            margin: 0;
        }

        .colldetail {
            display: flex;
            flex-direction: row;
        }

        .detail_desc {
            width: 50%;
        }

        .btn {
            background-color: #301934;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 20px 40px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #A778B3;
        }

        .pic img {
            width: 550px;
            height: 600px;
        }

        .share i {
            margin: 0 10px;
            font-size: 18px;
            color: #301934;
            cursor: pointer;
        }

        .share i:hover {
            color: #a778b3;
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

        .about p {
            margin: 5px 0;
        }

        .ratings {
            margin-top: 40px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
        }

        .ratings h2 {
            font-size: 24px;
            color: #301934;
            margin-bottom: 15px;
        }

        .review {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0 , 0.1);
        }

        .review .header{
            display:flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }    

        .username {
            font-weight: bold;
            font-size: 18px;
            color: #301934;
        }

        .time {
            color: #888;
            font-size: 14px;
        }

        .comment p {
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .myReview {
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0 , 0.1);
        }
        
        .myReview h2 {
            font-size: 24px;
            color: #301934;
            margin-bottom: 20px;
        }

        .myReview form input [type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .myReview form button {
            background-color: #301934;
            padding: 12px;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .myReview form button:hover {
            background-color: #a778b3;
        }

        @media(max-width: 768px) {
            .colldetail {
                flex-direction: column;
            }

            .pic img {
                width: 100%;
                height: auto;
            }

            .ratings, .myReview {
                padding: 15px;
            }

            .ratings h2, myReview h2 {
                font-size: 20px;
            }
        }
    </style>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav> 

    <div id="prdInfo" data-product-id="<?php echo htmlspecialchars($id); ?>"></div>

    <?php if (isset($display_message)) : ?>
        <div class="display_msg">
            <span><?php echo htmlspecialchars($display_message); ?></span>
            <i class="fas fa-times" onClick="this.parentElement.style.display = 'none';"></i>
        </div>
    <?php endif; ?>

    <div id="prd_details">
        <div class="colldetail">
            <div class="pic">
                <img src="<?php echo $content['image_url']; ?>" alt="<?php echo $content['name']; ?>">
            </div>
            <div class="info">
                <h1 class="detail_name"><?php echo $content ['name']; ?></h1>
                <p class="detail_desc"><?php echo $content ['description']; ?></p>

                <h2 class="detail_price"><?php echo $content ['price']; ?></h2>
                <form action="" method="post">
                    <input type="hidden" name="prd_id" value="<?php echo htmlspecialchars ($id) ?>">
                    <label for="quantity">Quantity:</label>
                    <input type= "number" id="quantity" name="quantity" value="1" min="1" max="10">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars ($content ['name']); ?>">
                    <input type="hidden" name="product_price"value="<?php echo htmlspecialchars ($content ['price']); ?>">
                    <input type="hidden" name="product_image"value="<?php echo htmlspecialchars ($content['image_url']); ?>">
                    <input class="btn btn--primary" name="btnAdd" type="submit" value="Add to cart">
                </form>
  
                <div class="about">
                    <p>🗸 Ordered before 10PM, in your house the day after</p>
                    <p>🗸 Free shipping fees from 35€</p>
                    <p>🗸 Unsatisfied, paid back in 3 days</p>
            </div>
        <div>
    </div>
    
    <div class="sharing">
        <p>Share this product:</p>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>

    <div class="ratings">
    <h2>Customer reviews</h2>
    <div class="list" id="reviewList">
        <?php 
            if (!empty($allComments)) {
                foreach ($allComments as $comment) {
                    // Fetch the username from the 'clients' table
                    $stmt = $db->prepare("SELECT first_name FROM clients WHERE id = ?");
                    $stmt->bind_param("i", $comment['client_id']);
                    $stmt->execute();
                    $clientResult = $stmt->get_result();
                    $client = $clientResult->fetch_assoc();
                    $username = $client['first_name'] ?? 'Anonymous'; // Default to 'Anonymous' if no result found

                    // Display the review
                    echo '<div class="review">';
                    echo '<div class="header">';
                    echo '<h3 class="username">' . htmlspecialchars($username) . '</h3>'; // Display fetched username
                    echo '<span class="time">' . htmlspecialchars($comment['date']) . '</span>';
                    echo '</div>';
                    echo '<div class="comment"><p>' . htmlspecialchars($comment['text']) . '</p></div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No reviews yet.</p>';
            }
        ?>
    </div>
</div>


    <div class="myReview">
    <h2>Add your review</h2>
    <form action="" method="POST" id="commentForm">
        <input type="text" id="reviewText" placeholder="What's your opinion on the product">
        <button type="submit" class="btn">Add comment</button>
    </form>
    </div>

</body>
</html>
