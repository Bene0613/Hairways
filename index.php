<?php
//$conn= new mysqli('localhost', 'root', '', 'Hairways');
    //select * from products and loop

   // $sql = "SELECT * FROM product";
    //$result = $conn->query($sql);
    //$product = $result->fetch_all(MYSQLI_ASSOC);

    $conn = new PDO ('mysql:dbname=Hairways;host=localhost',"root", "");

    // select * frpm products and fetch as array
    $statement = $conn -> prepare('SELECT * FROM product');
    $statement->execute();
    $product = $statement->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ways to love your hair with Hairways </h1>
    <?php foreach($product as $prod): ?>
    <article>
        <h2> <?php echo $prod ['name'];?></h2>
    </article>
    <?php endforeach; ?>
</body>
</html>