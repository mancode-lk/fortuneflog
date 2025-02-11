<?php
include 'conn.php';




    // Validate input
    $productId=$_REQUEST['productId'];
    
    $size =$_REQUEST['size'];

    if (!$productId || empty($size)) {
        throw new Exception('Invalid input data');
    }

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO tbl_sizes (size, product_id) VALUES (?, ?)");
    $stmt->bind_param("si", $size, $productId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to insert data: ' . $stmt->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Detail added successfully!'
    ]);

$conn->close();
?>