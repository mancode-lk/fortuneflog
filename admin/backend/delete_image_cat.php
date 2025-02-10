<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imgId = $_POST['cat_id'];
    $imagePath = $_POST['image_path'];

    if (!empty($imgId) && !empty($imagePath)) {
        // Check if the image exists in the database
        $sql = "SELECT cat_image FROM tbl_categories WHERE cat_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $imgId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbImage);
            $stmt->fetch();

            // Construct full image path
            $fullImagePath = "../uploads/categories/" . basename($dbImage);

            // Delete the image file from the server
            if (file_exists($fullImagePath) && unlink($fullImagePath)) {
                // Delete the image record from the database
                $deleteSql = "UPDATE tbl_categories SET cat_image = NULL WHERE cat_id = ?";
                $deleteStmt = $conn->prepare($deleteSql);
                $deleteStmt->bind_param("i", $imgId);

                if ($deleteStmt->execute()) {
                    echo "<script> window.location.href='../categories.php';</script>";
                } else {
                    echo "<script>alert('Database error! Please try again.'); window.history.back();</script>";
                }

                $deleteStmt->close();
            } else {
                echo "<script>alert('Failed to delete image file!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Image not found!'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid request!'); window.history.back();</script>";
    }
}

$conn->close();
?>