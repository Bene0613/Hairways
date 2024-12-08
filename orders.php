<?php
session_start();
//if(!isset($_SESSION['client_id']) ){
    //exit("Please log in to view your orders.");
//}
    $_SESSION['client_id'] = 1;
    $client_id = $_SESSION['client_id'];

    $conn = new mysqli("localhost","root","","hairrways");
    $stmt = $conn->prepare("SELECT * FROM orders WHERE client_id = ? ORDER BY order_date DESC");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
    </style>
</head>
<body>
<nav class="nbar">
        <div class="one">
        <?php include_once("nav.inc.php"); ?>
        </div>
    </nav> 
    <h1>All your orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>State</th>
            </tr>
        </thead>
        <?php foreach ($orders as $ord): ?>
            <tr>
            <td><?php echo htmlspecialchars ($ord['id']); ?></td>
            <td><?php echo htmlspecialchars ($ord['order_date']); ?></td>
            <td><?php echo $ord['amount']; ?></td>
            <td><?php echo $ord['state']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>