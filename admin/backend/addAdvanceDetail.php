<?php
include 'conn.php';




    // Validate input
    $productId=$_REQUEST['productId'];
    
    $heading =$_REQUEST['heading'];
    $desc = $_REQUEST['desc'];

    if (!$productId || empty($heading) || empty($desc)) {
        throw new Exception('Invalid input data');
    }

    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO tbl_advance_details (ad_heading, ad_description, product_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $heading, $desc, $productId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to insert data: ' . $stmt->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Detail added successfully!'
    ]);

$conn->close();
?>