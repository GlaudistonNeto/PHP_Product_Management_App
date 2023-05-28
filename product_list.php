<?php

require_once 'ConcreteProduct.php';

// Database connection
$servername = 'localhost';
$username = 'your_username';
$password = 'your_password';
$dbname = 'your_database';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    $products = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $product = new ConcreteProduct($row['id'], $row['name'], $row['price']);
        $products[] = $product;
    }

    // Convert products array to JSON and send response
    echo json_encode($products);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
