<?php
include 'conn.php';

    $productId = $_REQUEST['productId'];
    $offer = $_REQUEST['offer'];
    $expiryDate = $_REQUEST['expiryDate'];

    if (!$productId || empty($offer)) {
        echo 300;
        exit;
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO tbl_offer (offer_percentage, expiry_date, product_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $offer, $expiryDate, $productId);

    if (!$stmt->execute()) {
        throw new Exception('Failed to insert data: ' . $stmt->error);
    }

    echo 200;


$conn->close();

?>
