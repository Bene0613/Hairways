<?php
// Initialize the MySQL connection
$conn = new mysqli("localhost", "root", "", "hairrways");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<style>
        
        .nbar {
           display: flex;
           justify-content: space-between;
           align-items: center;
           padding: 10px 20px;
           background-color: #f8f8f8;
           box-shadow: 0px 2px 5px rgba(0,0,0,0.1); 
           width: 50vw;
        }


        .one ul, .two ul {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
            margin:0;
            padding:0;
        }

        .one a, .two a {
            text-decoration: none;
            color: #050505;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .nbar a:hover {
            text-decoration: underline;
            text-decoration-color: #A77BB3;
            color: #A77BB3;
        }

        .center .logo img {
            width: 50px;
            height: auto;
        }

        .seachy {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .searchy input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
        }

        .searchy button {
            padding: 5px 10px;
            background-color: #301934;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3 ease;
        }

        .searchy button:hover {
            background-color: #A778B3;
        }

        .fa-user, .fa-cart-shopping {
            font-size: 20px;
            color: #050505;
        }

        @media (max-width: 768px) {
            .nbar {
                flex-wrap: wrap;
            }

            .one, .two {
                flex: 1 1 100%; /*bron: internet*/
                display:flex;
                justify-content: center;
                margin-bottom: 10px;
            }

            .searchy input {
                width: 150px
            }
        }
    </style>
<nav class="nbar">
    <div class="one">
        <ul>
            <li><a href="product.php">SHOP</a></li>
            <li><a href="bestseller.php">BESTSELLERS</a></li>
            <li><a href="sets.php">SETS</a></li>
            <li><a href="about.php">ABOUT US</a></li>
        </ul>  
    </div>

    <div class="center">
        <a href="index.php" class="logo">
            <img src="images/1x/Middel 1.png" alt="logo">
        </a>     
    </div>
           
    <div class="two">
        <ul>
            <li>
                <form action="" method="GET" class="searchy">
                    <input type="text" name="search" placeholder="Search for products..." required>
                    <button type="submit">Search</button>
                </form>
            </li>
            <li><a href="orders.php"><i class="fa-solid fa-user" style="color: #050505;"></i></a></li>
            <?php
                // Query for the cart items
                $select_prd = mysqli_query($conn, "SELECT * from cart") or die('Query failed');
                $row_count = mysqli_num_rows($select_prd);
            ?>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: #050505;"></i></a><span><sup><?php echo $row_count ?></sup></span></li>
            <li><a href="logout.php" title="Logout"><i class="fa-solid fa-sign-out-alt" style="color: #050505;"></i></a></li>
        </ul>
    </div>
</nav>
