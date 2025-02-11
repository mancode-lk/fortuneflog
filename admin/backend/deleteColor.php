<?php
include 'conn.php';

$colorId = $_POST['colorId'] ?? 0;

$sqlDelete = "DELETE FROM tbl_color WHERE col_id   = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $colorId);
$success = $stmt->execute();

echo json_encode(["success" => $success, "message" => $success ? "Detail deleted successfully" : "Error deleting detail"]);
?>