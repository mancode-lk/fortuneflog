<?php
include 'conn.php';

$offerId = $_POST['offerId'] ?? 0;

$sqlDelete = "DELETE FROM tbl_offer WHERE offer_id   = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $offerId);
$success = $stmt->execute();

echo json_encode(["success" => $success, "message" => $success ? "Detail deleted successfully" : "Error deleting detail"]);
?>