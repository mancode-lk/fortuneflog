<?php
include 'conn.php';




    // Validate input
    $productId=$_REQUEST['productId'];
    
    $details =$_REQUEST['details'];
    $specs = $_REQUEST['specs'];

    if (!$productId || empty($specs) || empty($details)) {
        throw new Exception('Invalid input data');
    }

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO tbl_specifications (spec_name, spec_value, product_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $specs, $details, $productId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to insert data: ' . $stmt->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Detail added successfully!'
    ]);

$conn->close();
?>