<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
        echo "<script>alert('Product ID is missing!'); window.history.back();</script>";
        exit();
    }

    $product_id = intval($_POST['product_id']);
    $uploadDir = '../uploads/products/';
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Debugging: Check if file is received
    if (!isset($_FILES['productImages']) || $_FILES['productImages']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error uploading file!'); window.history.back();</script>";
        exit();
    }

    $fileName = basename($_FILES['productImages']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowedExtensions)) {
        echo "<script>alert('Invalid file type!'); window.history.back();</script>";
        exit();
    }

    $newFileName = time() . "_" . rand(1000, 9999) . "." . $fileExt;
    $uploadPath = $uploadDir . $newFileName;

    // Debugging: Ensure directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
    }

    if (move_uploaded_file($_FILES['productImages']['tmp_name'], $uploadPath)) {
        // ✅ Update the image in `tbl_products`
        $sqlUpdate = "UPDATE tbl_products SET p_image = ? WHERE p_id = ?";
        $stmt = $conn->prepare($sqlUpdate);
        
        if (!$stmt) {
            die("<script>alert('SQL error: " . $conn->error . "'); window.history.back();</script>");
        }

        $stmt->bind_param("si", $newFileName, $product_id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../products.php?success=Image updated successfully");
            exit();
        } else {
            echo "<script>alert('Database error! " . $stmt->error . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image!'); window.history.back();</script>";
    }
} else {
    header("Location: ../products.php?error=Invalid Request");
    exit();
}
?>
