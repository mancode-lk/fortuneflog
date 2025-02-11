<?php 
include '../backend/conn.php'; 

// Get productId from request
$productId = $_REQUEST['productId']; // Ensure it's an integer to prevent SQL injection

// Fetch offer details from database
$sql = "SELECT * FROM tbl_offer WHERE product_id = '$productId'";
$rs = $conn->query($sql);

?>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Offer Percentage</th>
            <th>Expiry Date</th>
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
            <td><?= htmlspecialchars($row['offer_percentage']) ?>%</td>
            <td>
            <?= !empty($row['expiry_date']) && $row['expiry_date'] !== '0000-00-00' ? htmlspecialchars($row['expiry_date']) : '<span class="text-muted">No Expiry</span>' ?>

            </td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="deleteOffer(<?= $row['offer_id'] ?>, <?= $productId ?>)">Delete</button>
            </td>
        </tr>
        <?php 
            } 
        } else { 
        ?>
        <tr>
            <td colspan="4" class="text-center">No offers found.</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
