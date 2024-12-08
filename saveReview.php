<?php

session_start();
include_once(__DIR__ . "/../classes/database.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
      echo json_encode(['message' => 'User not logged in']);
      Exit;
  }

    $productId = $_POST['productId'];
    $theText = $_POST['commentText'];

    $clientId = $_SESSION['user_id'];

    $db = new Database("localhost", "root", "", "hairrways");
    $stmt = $db->prepare("INSERT INTO comments (text, product_id, client_id) VALUES (?,?,?,?)");
    $stmt->bind_param("sii", $theText, $productId, $clientId);

    if($stmt->execute()) {
        $response = [
            'message' => 'Review added successfully',
            'body' => htmlspecialchars($theText),
            'user' => 'Bene Tshimanga',
            'date' => date('d/m/y')
        ];
    } else {
     $response = [
            'message' => 'Error saving review',
            'body' => ''
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response); 
    }
?>