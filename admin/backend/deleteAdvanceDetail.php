<?php
include 'conn.php';

$adId = $_POST['ad_id'] ?? 0;

$sqlDelete = "DELETE FROM tbl_advance_details WHERE ad_id = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $adId);
$success = $stmt->execute();

echo json_encode(["success" => $success, "message" => $success ? "Detail deleted successfully" : "Error deleting detail"]);
?>