<?php
// include "conn.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $catId = $_POST["cat_id"];

//     // Get image filename before deletion
//     $sqlImage = "SELECT cat_image FROM tbl_categories WHERE cat_id = ?";
//     $stmtImage = $conn->prepare($sqlImage);
//     $stmtImage->bind_param("i", $catId);
//     $stmtImage->execute();
//     $stmtImage->bind_result($imageFile);
//     $stmtImage->fetch();
//     $stmtImage->close();

//     // Delete category
//     $sqlDelete = "DELETE FROM tbl_categories WHERE cat_id = ?";
//     $stmtDelete = $conn->prepare($sqlDelete);
//     $stmtDelete->bind_param("i", $catId);

//     if ($stmtDelete->execute()) {
//         // Delete the image file if exists
//         if (!empty($imageFile)) {
//             $imagePath = "../uploads/categories/" . $imageFile;
//             if (file_exists($imagePath)) {
//                 unlink($imagePath);
//             }
//         }
//         echo "<script> window.location.href='../categories.php';</script>";
//     } else {
//         echo "<script>alert('Failed to delete category!'); window.history.back();</script>";
//     }

//     $stmtDelete->close();
// }
// $conn->close();
?>
