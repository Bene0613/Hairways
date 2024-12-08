<?php
    if(!isset($_GET['id']) ){
        exit("Product not found");
      }
    
      include_once('data.inc.php');
      $id = $_GET['id'];
      $content = $collection[$id];


    $conn = new mysqli("localhost","root","","hairrways");
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $content = $result->fetch_assoc();

    if(isset($_POST['btnAdd'])) {
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_image=$_POST['product_image'];
        $product_quantity=1;

        $insert_product = mysqli_query($conn,"INSERT INTO cart (name, price, image, quantity) VALUES ('$product_name', '$product_price', '$product_image', $product_quantity)");

        if($insert_product) {
            $display_message="Product succesfully added to cart";
        } else {
            echo "Error" . mysqli_error($conn);
        }
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
        }

            .myReview form input[type="text"]{
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border-radius: 5px;
                border: 3px solid #ccc;
            }

        .review {
            margin-bottom: 20px;
        }    

        .username {
            font-weight: bold;
            font-size: 18px;
        }

        .time {
            color: #888;
            font-size: 14px;
        }

        .comment {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav> 
    <?php
    if (isset($display_message)) {
            echo "<div class='display_msg'>
            <span>$display_message</span>
            <i class='fas fa-times' onClick='this.parentElement.style.display = \"none\";'></i>
        </div>";
        }
?>

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
                    <input type="hidden" name="prd_id" value="<?php echo $id ?>">
                    <label for="quantity">Quantity:</label>
                    <input type= "number" id="quantity" name="quantity" value="1" min="1" max="1">
                    <input type="hidden" name="product_name" value="<?php echo $content ['name']; ?>">
                    <input type="hidden" name="product_price"value="<?php echo $content ['price']; ?>">
                    <input type="hidden" name="product_image"value="<?php echo $content['image_url']; ?>">
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
        <div class="list">
            <div class="review">
                <div class="header">
                    <h3 class="username">Bene Tshimanga</h3>
                    <span class="time">03/12/2024</span>
                </div>
                <div class="comment">
                    <p>Amazing product it exced my expectation!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="myReview">
        <h2>Add your review</h2>
        <form action="" method="POST">
            <input type="text" placeholder="What's on your mind">
            <button type="submit" class="btn">Add comment</button>
        </form>    
    </div>
</body>
</html>