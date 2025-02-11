<?php
include '../backend/conn.php'; 

// Get productId from request
$productId = $_REQUEST['productId'];

// Fetch details from database
$sql = "SELECT * FROM tbl_sizes WHERE product_id = '$productId'";
$rs = $conn->query($sql);
?>


<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Size</th>
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
            <td><?= htmlspecialchars($row['size']) ?></td>
            <td>
               
                <button class="btn btn-sm btn-danger" onclick="deleteSize(<?= $row['size_id'] ?>,<?= $productId ?>)">Delete</button>
            </td>
        </tr>
        <?php 
            } 
        } else { 
        ?>
        <tr>
            <td colspan="5" class="text-center">No details found.</td>
        </tr>
        <?php } ?>
    </tbody>
</table>