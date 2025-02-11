<?php
include '../backend/conn.php'; 

// Get productId from request
$productId = intval($_REQUEST['productId']); // Ensure it's an integer to prevent SQL injection

// Fetch details from database
$sql = "SELECT * FROM tbl_color WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$rs = $stmt->get_result();
?>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Colors</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($rs->num_rows > 0) {
            $count = 1;
            while ($row = $rs->fetch_assoc()) { 
        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td>
                <span class="badge rounded-pill text-white" style="background-color: <?= htmlspecialchars($row['color_name']) ?>;">
                    <?= htmlspecialchars($row['color_name']) ?>
                </span>
            </td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="deleteColor(<?= $row['col_id'] ?>, <?= $productId ?>)">Delete</button>
            </td>
        </tr>
        <?php 
            } 
        } else { 
        ?>
        <tr>
            <td colspan="3" class="text-center">No colors found.</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
