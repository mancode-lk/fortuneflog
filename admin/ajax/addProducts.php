<?php
include "../backend/conn.php"; // Ensure connection is included
?>
<div class="container card shadow-lg p-4 mt-4">
    <div class="text-center mb-4">
        <h4 class="modal-title fw-bold text-primary">Add Product</h4>
        <p class="text-muted">Fill in the form below to add a product</p>
    </div>
    <form method="post" action="backend/addProduct.php" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="pTitle" class="form-label fw-semibold">Product Title</label>
            <input 
                type="text" 
                name="pTitle" 
                id="pTitle" 
                class="form-control shadow-sm border-primary" 
                placeholder="Enter product title" 
                required>
        </div>
        
        <div class="form-group mb-3">
            <label for="pCat" class="form-label fw-semibold">Product Category</label>
            <select name="pCat" id="pCat" class="form-control shadow-sm border-primary">
                <option value="">Select category</option>
                <?php
                

                $sqlCat = "SELECT * FROM tbl_categories";
                $rsCat = $conn->query($sqlCat);

                if ($rsCat->num_rows > 0) {
                    while ($rowsCat = $rsCat->fetch_assoc()) {
                        ?>
                        <option value="<?= $rowsCat['cat_id'] ?>"><?= htmlspecialchars($rowsCat['cat_name']) ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="pImage" class="form-label fw-semibold">Product Image</label>
            <input 
                type="file" 
                name="pImage" 
                id="pImage" 
                class="form-control shadow-sm border-primary"
                accept="image/*" 
                required>
        </div>
        <div class="form-group mb-3">
            <label for="pDescription" class="form-label fw-semibold">Product Description</label>
            <textarea 
                name="pDescription" 
                id="pDescription" 
                class="form-control shadow-sm border-primary" 
                rows="3" 
                placeholder="Enter product description" 
                required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="pPrice" class="form-label fw-semibold">Product Price</label>
            <input 
                type="number" 
                name="pPrice" 
                id="pPrice" 
                class="form-control shadow-sm border-primary"
                placeholder="Enter product price"
                step="0.01"
                required>
        </div>
        <div class="form-group mb-3">
            <label for="pAge" class="form-label fw-semibold">Product Age</label>
            <input 
                type="number" 
                name="pAge" 
                id="pAge" 
                class="form-control shadow-sm border-primary"
                placeholder="Enter age suitability"
                required>
        </div>
        <div class="form-group mb-3">
            <label for="pType" class="form-label fw-semibold">Product Type</label>
            <select 
                name="pType" 
                id="pType" 
                class="form-control shadow-sm border-primary" 
                required>
                <option value="0">Antique</option>
                <option value="1">Retro</option>
            </select>
        </div>
        <div class="d-grid">
            <button 
                type="submit" 
                class="btn btn-primary btn-lg shadow-sm">
                Add Product
            </button>
        </div>
    </form>
</div>
