<?php
include 'conn.php';




    // Validate input
    $productId=$_REQUEST['productId'];
    
    $color =$_REQUEST['color'];

    if (!$productId || empty($color)) {
        throw new Exception('Invalid input data');
    }

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO tbl_color (color_name, product_id) VALUES (?, ?)");
    $stmt->bind_param("si", $color, $productId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to insert data: ' . $stmt->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Detail added successfully!'
    ]);

$conn->close();
?>