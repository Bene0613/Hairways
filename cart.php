<?php
session_start();
include_once'./classes/database.php';
$db = new Database("localhost", "root", "", "hairrways");

// Handle Update Quantity
if (isset($_POST['updatePrdQuanti'])) {
    $update_value = $_POST['updateQuantity'];
    $update_id = $_POST['updateQUantiId'];

    // Update query
    $update_query = "UPDATE cart SET quantity=$update_value WHERE id=$update_id";
    if ($db->query($update_query)) {
        header('Location: cart.php');
        exit();
    }
}

// Handle Remove Item
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = "DELETE FROM cart WHERE id=$remove_id";
    $db->query($remove_query);
}

// Handle Remove All Items
if (isset($_GET['delete_all'])) {
    $db->query("DELETE FROM cart");
    header('Location: cart.php');
    exit();
}

?>
<!DOCTYPE html>
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

        .shopping_cart {
            padding: 20px;
            max-width: 1200px;
            margin:0;
        }

        .heading {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align:left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        td img {
            width: 15%;
            height: auto;
        }

        .bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f8f8f8;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

        .bottom h3 {
            font-size;
            font-weight;
            margin: 0;
            color: #050505;
        }

        .bottom h3 span {
            color: #a778b3;
        }

        .empty_text {
            text-align: center;
            font-size: 18px;
            font-style: italic;
        }

        .deleteAll_btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #d32f2f;
            color:white;
            padding: 10px 20px;
            margin-left: 16px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .deleteAll_btn:hover {
            background-color: #a52727;
            text-decoration: none;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav>
        <h1 class="heading">My cart</h1>
       <table>
        <?php 
            $select_cart_product=mysqli_query($conn, "SELECT * from cart");
            $num=1;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart_product)>0) {
                echo " <thead>
            <th>Serial N°</th>
            <th>Product name</th>
            <th>Product image</th>
            <th>Product price</th>
            <th>Product quantity</th>
            <th>Total price</th>
            <th>Action</th>
            </thead>
            <tbody>";
            
            while($fetch_cart_products=mysqli_fetch_assoc( $select_cart_product)) {
                ?>
                    <tr>
                <td><?php echo $num ?></td>
                <td><?php echo $fetch_cart_products['name'] ?></td>
                <td><?php echo $fetch_cart_products['image'] ?></td>
                <td>€<?php echo $fetch_cart_products['price'] ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" value="<?php echo $fetch_cart_products['id'] ?>" name="updateQUantiId">
                    <div class="quantityBox">
                        <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity'] ?>" name="updateQuantity">
                        <input type="submit" class="updateQuantity" value="Update" name="updatePrdQuanti">
                    </div>
                    </form>
                </td>
                <td>€<?php echo $subtotal= ($fetch_cart_products['price']*$fetch_cart_products['quantity'])?></td>
                <td>
                    <a href="cart.php?remove=<?php echo $fetch_cart_products['id']?>"><i class="fa-solid fa-trash" style="color: #ae1004;"></i>Remove</a>
                </td>
            </tr>
            <?php
            $grand_total= $grand_total+($fetch_cart_products['price']*$fetch_cart_products['quantity']);
            $num++;
            }

            }else {
                echo "<div class='empty_text'>Cart is empty</div>";
            }
        ?>
       
        </tbody>
       </table>
       <div class="bottom">
        <a href="products.php" class="bottom_btn">Continue Shopping</a>
        <h3 class="bottom_btn">Total: <span>€<?php echo $grand_total ?></span></h3>
        <a href="checkout.php" class="bottom_btn">Checkout</a>
       </div>
       <a href="cart.php?delete_all" class="deleteAll_btn">
            <i class="fas fa-trash"></i>Delete ALL</a>
       </a>
</body>
</html>