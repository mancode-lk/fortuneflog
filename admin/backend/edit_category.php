<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catId = $_POST["cat_id"];
    $catName = $_POST["cat_name"];
    $catDescription = $_POST["cat_description"];

    $sql = "UPDATE tbl_categories SET cat_name = ?, cat_description = ? WHERE cat_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $catName, $catDescription, $catId);

    if ($stmt->execute()) {
        echo "<script>window.location.href='../categories.php';</script>";
    } else {
        echo "<script>alert('Failed to update category!'); window.history.back();</script>";
    }

    $stmt->close();
}
$conn->close();
?>
