<?php
include 'conn.php';

$sizeId = $_POST['sizeId'] ?? 0;

$sqlDelete = "DELETE FROM tbl_sizes WHERE size_id   = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $sizeId);
$success = $stmt->execute();

echo json_encode(["success" => $success, "message" => $success ? "Detail deleted successfully" : "Error deleting detail"]);
?>