<?php 
include '../backend/conn.php';
$productId = intval($_REQUEST['productId']);
?>
<div class="modal-header">
    <h5 class="modal-title">Details Manager - Product #<?= $productId ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <!-- Tabs Navigation -->
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-features-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-features" type="button" role="tab" 
                    aria-controls="nav-features" aria-selected="true" onclick="openAdvanceDetail(<?= $productId ?>)">
                Advance Details
            </button>
            <button class="nav-link" id="nav-specs-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-specs" type="button" role="tab" 
                    aria-controls="nav-specs" aria-selected="false" onclick="openAdditionalInfo(<?= $productId ?>)">
                Additional Information
            </button>
        </div>
    </nav>

    <!-- Tabs Content -->
    <div class="tab-content mt-3" id="nav-tabContent">
        <!-- Features Tab -->
        <div class="tab-pane fade show active" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab">
            <div class="mb-3">
                <form id="advanceDetailForm" class="row g-3">
                    <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">
                    <div class="col-md-9">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" id="heading" required>
                    </div>
                    <div class="col-md-9">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" name="desc" id="desc" rows="2" required></textarea>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="addProduct()">Add</button>
                    </div>
                </form>
            </div>
            <div id="getAdvanceList" class="list-group">
                <!-- Existing details loaded via AJAX -->
            </div>
        </div>

        <!-- Specifications Tab -->
        <div class="tab-pane fade" id="nav-specs" role="tabpanel" aria-labelledby="nav-specs-tab">
            <div class="mb-3">
                <form id="specificationForm" class="row g-3">
                    <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">
                    <div class="col-md-4">
                        <label for="specs" class="form-label">Specification</label>
                        <input type="text" class="form-control" name="specs" id="specs" required>
                    </div>
                    <div class="col-md-5">
                        <label for="details" class="form-label">Details</label>
                        <input type="text" class="form-control" name="details" id="details" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="addSpecs()">>Add</button>
                    </div>
                </form>
            </div>
            <div id="specsList" class="list-group">
                <!-- Existing specs loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
</script>