<?php
include "conn.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
        echo "<script>alert('Product ID is missing!'); window.history.back();</script>";
        exit();
    }
    $product_id = intval($_POST['product_id']);
    $feature_text = htmlspecialchars($_POST['feature_text']);

    if (!empty($feature_text)) {
        // Insert feature text into tbl_features
        $sqlInsert = "INSERT INTO tbl_features (product_id, feature_text) VALUES (?, ?)";
        $stmt = $conn->prepare($sqlInsert);
        $stmt->bind_param("is", $product_id, $feature_text);

        if ($stmt->execute()) {
            echo "<script>alert('Feature added successfully'); window.history.back();</script>";
        } else {
            echo "<script>alert('Error while adding feature.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Feature text cannot be empty.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>
