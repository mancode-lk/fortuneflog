<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feature_id'])) {
    try {
        $featureId = filter_input(INPUT_POST, 'feature_id', FILTER_VALIDATE_INT);
        
        if (!$featureId) {
            throw new Exception("Invalid feature ID");
        }

        $sql = "DELETE FROM tbl_features WHERE feature_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $featureId);
        
        if (!$stmt->execute()) {
            throw new Exception("Database error: " . $stmt->error);
        }
        
        if ($stmt->affected_rows === 0) {
            echo "No feature found with this ID";
        } else {
            echo "success";
        }

    } catch (Exception $e) {
        http_response_code(400);
        echo $e->getMessage();
    } finally {
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
} else {
    http_response_code(405);
    echo "Invalid request method";
}
?>