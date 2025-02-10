<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $uploadDir = '../uploads/products_more_images/';
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!empty($_FILES['productImages']['name'][0])) {
        foreach ($_FILES['productImages']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['productImages']['name'][$key]);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowedExtensions)) {
                $newFileName = time() . "_" . rand(1000, 9999) . "." . $fileExt;
                $uploadPath = $uploadDir . $newFileName;

                if (move_uploaded_file($tmp_name, $uploadPath)) {
                    // Insert image path into tbl_images
                    $sqlInsert = "INSERT INTO tbl_images (product_id, image_path) VALUES (?, ?)";
                    $stmt = $conn->prepare($sqlInsert);
                    $stmt->bind_param("is", $product_id, $newFileName);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
        header("Location: ../products.php?success=Images uploaded successfully");
        exit();
    }
} else {
    header("Location: ../products.php?error=Invalid Request");
    exit();
}
?>
