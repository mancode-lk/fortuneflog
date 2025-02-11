<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = intval($_POST['product_id']); // Corrected to match form input name
    $pTitle = trim($_POST['pTitle']);
    $pDescription = trim($_POST['pDescription']);
    $pPrice = floatval($_POST['pPrice']);
    $pAge = intval($_POST['pAge']);
    $pType = intval($_POST['pType']);

    $sql = "UPDATE tbl_products
            SET p_title = ?, p_description = ?, p_price = ?, p_age = ?, p_type = ?
            WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisi", $pTitle, $pDescription, $pPrice, $pAge, $pType, $productId);

    if ($stmt->execute()) {
        header("Location: ../products.php?success=Product updated successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
