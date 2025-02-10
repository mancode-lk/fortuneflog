<?php
include 'conn.php';

$specId = $_POST['specId'] ?? 0;

$sqlDelete = "DELETE FROM tbl_specifications WHERE spec_id  = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $specId);
$success = $stmt->execute();

echo json_encode(["success" => $success, "message" => $success ? "Detail deleted successfully" : "Error deleting detail"]);
?>