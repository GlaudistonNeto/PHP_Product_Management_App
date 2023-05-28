<?php

require_once 'ConcreteProduct.php';

// Retrieve the product data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Perform validation if needed

// Save the product to the database
$servername = 'localhost';
$username = 'your_username';
$password = 'your_password';
$dbname = 'your_database';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO products (name, price) VALUES (:name, :price)");
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->execute();

    $productId = $conn->lastInsertId();

    // Create a product instance with the generated ID
    $product = new ConcreteProduct($productId, $data['name'], $data['price']);

    // Optionally, you can return the saved product as JSON
    echo json_encode($product);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
