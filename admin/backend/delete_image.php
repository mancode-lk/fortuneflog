<?php
include "conn.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = $_POST['image_path'] ?? '';
    $imageId = $_POST['image_id'] ?? ''; // Could be either a product ID or tbl_images ID
    $isMainImage = $_POST['is_main_image'] ?? ''; // Determines if it's from tbl_products or tbl_images

    if (!empty($imageId) && !empty($imagePath)) {
        $fullImagePath = "../uploads/products/" . basename($imagePath);
        $fullImagePath2 = "../uploads/products_more_images/" . basename($imagePath);
        $deleteSuccess = false;

        if ($isMainImage == "1") {
            // Image belongs to tbl_products (Main Product Image)
            $sql = "SELECT p_image FROM tbl_products WHERE p_id = ?";
        } else {
            // Image belongs to tbl_images (Additional Images)
            $sql = "SELECT image_path FROM tbl_images WHERE image_id = ?";
        }

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $imageId);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($dbImage);
                $stmt->fetch();

                // Attempt to delete from the correct directory
                if (file_exists($fullImagePath) && unlink($fullImagePath)) {
                    if ($isMainImage == "1") {
                        // Remove image reference from tbl_products
                        $deleteSql = "UPDATE tbl_products SET p_image = NULL WHERE p_id = ?";
                    } 
                    $deleteSuccess = true;
                } elseif (file_exists($fullImagePath2) && unlink($fullImagePath2)) {
                    // Remove image record from tbl_images
                    $deleteSql = "DELETE FROM tbl_images WHERE image_id = ?";
                    $deleteSuccess = true;
                } else {
                    echo "<script>alert('Failed to delete image file!'); window.history.back();</script>";
                    exit;
                }

                if ($deleteSuccess) {
                    if ($deleteStmt = $conn->prepare($deleteSql)) {
                        $deleteStmt->bind_param("i", $imageId);
                        if ($deleteStmt->execute()) {
                            echo "<script> window.location.href='../products.php';</script>";
                        } else {
                            echo "<script>alert('Database error! Please try again.'); window.history.back();</script>";
                        }
                        $deleteStmt->close();
                    }
                }
            } else {
                echo "<script>alert('Image not found!'); window.history.back();</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Database query failed!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invalid request!'); window.history.back();</script>";
    }
}

$conn->close();
?>
