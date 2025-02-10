<?php
include "conn.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cat_image"])) {
    $catId = $_POST["cat_id"];
    $uploadDir = "../uploads/categories/"; // Image upload directory

    // Check if category ID is provided
    if (empty($catId)) {
        echo "<script>alert('Invalid category!'); window.history.back();</script>";
        exit();
    }

    // Validate and process the uploaded image
    $fileName = time() . "_" . basename($_FILES["cat_image"]["name"]); // Unique file name
    $uploadFile = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["cat_image"]["tmp_name"], $uploadFile)) {
            // Update the database with the new image path
            $sql = "UPDATE tbl_categories SET cat_image = ? WHERE cat_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $fileName, $catId);

            if ($stmt->execute()) {
                echo "<script> window.location.href='../categories.php';</script>";
            } else {
                echo "<script>alert('Database update failed!'); window.history.back();</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('File upload failed!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG, and GIF allowed.'); window.history.back();</script>";
    }
}

$conn->close();
?>
