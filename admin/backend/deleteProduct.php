<?php
// Include database connection
include 'conn.php';

if (isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);

    // Start transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Fetch the product to get the image paths before deleting
        $sqlProduct = "SELECT p_image FROM tbl_products WHERE p_id = ?";
        $stmt = $conn->prepare($sqlProduct);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $mainImagePath = $product['p_image'];

        // Delete related features
        $sqlFeatures = "DELETE FROM tbl_features WHERE product_id = ?";
        $stmt = $conn->prepare($sqlFeatures);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        // Delete additional images
        $sqlImages = "SELECT image_path FROM tbl_images WHERE product_id = ?";
        $stmt = $conn->prepare($sqlImages);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $imageResult = $stmt->get_result();

        // Delete all additional images from the file system
        while ($image = $imageResult->fetch_assoc()) {
            $imagePath = '../uploads/products_more_images/' . $image['image_path'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Unlink (delete) the image file
            }
        }

        // Delete all additional images from the database
        $sqlDeleteImages = "DELETE FROM tbl_images WHERE product_id = ?";
        $stmt = $conn->prepare($sqlDeleteImages);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        // Delete the main product image
        if ($mainImagePath && file_exists('../uploads/products/' . $mainImagePath)) {
            unlink('../uploads/products/' . $mainImagePath); // Unlink (delete) the main product image
        }

        // Delete the product itself
        $sqlDeleteProduct = "DELETE FROM tbl_products WHERE p_id = ?";
        $stmt = $conn->prepare($sqlDeleteProduct);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();
        
        echo "success"; // Indicate successful deletion
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
