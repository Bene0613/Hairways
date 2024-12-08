<?php 
session_start();
include_once'./classes/database.php';

$db = new Database("localhost", "root", "", "hairrways");

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !=='admin') {
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])) {
    $productId = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param ('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();


    if(!$product) {
        header("Location: product.php");
        exit();
    }
    $categories = $db->query("SELECT id, name FROM categories");
} else {
    header("Location: product.php");
    exit();
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pname = $_POST['product_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category'];
    $image_folder = $product['image_url'];
}

if (isset($_FILES['images'])&& $_FILES['images']['error'] === UPLOAD_ERR_OK) {
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_name = basename ($_FILES['image']['name']);
    $image_more = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $sorts = ['jpg', 'png', 'jpeg', "webp"];

    if (in_array($image_more, $sorts)) {
        $new_img = uniqid() . '.' . $image_more;
        $image_folder = 'images/1x/' . $new_img;

        if(!move_uploaded_file($image_tmp_name, $image_folder)) {
            $display_message= "Error: Upload of the image has failed";
        }
    } else {
        $display_message= "File type is not allowed";
    }
        
    if(!isset($display_message)) {
        $stmt = $db->prepare("UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, category_id = ? WHERE id = ?");
        $stmt->bind_param ("ssdsii", $pname, $desc, $price, $image_folder, $category_id, $productId,);

        if($stmt->execute()) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $display_message= "Product updated successfully";
        } else {
            $display_message= "There is some error updating product";
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
</style>
</head>
<body>
<div class="around">
<?php if (isset($display_message)) : ?>
        <div class="display_msg">
            <span><?php echo htmlspecialchars($display_message); ?></span>
            <i class="fas fa-times" onClick="this.parentElement.style.display = 'none';"></i>
        </div>
        <?php endif; ?>
        
    <section>
            <h3 class="heading">Edit a product</h3>
            <form action="" method="POST" enctype="multipart/form-data">
              <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" class="inputField" required>
              <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" class="inputField" required>
              <input type="number" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" class="inputField" required>
              <input type="file" name="image" class="inputField" accept="image/png, image/jpg, image/webp">
                <select class="category" name="category" placeholder="Category" required>
                    <?php while ($cat = $categories -> fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                   <?php endwhile; ?> 
                </select>

                <input type="submit" value="Update product" class="submit_btn">
            </form>
        
            <a href="product.php"> Back to product list </a>
        </section>
</div>
</body>
</html>