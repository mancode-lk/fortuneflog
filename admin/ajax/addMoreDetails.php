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
            <button class="nav-link" id="nav-feat-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-feat" type="button" role="tab" 
                    aria-controls="nav-feat" aria-selected="false" onclick="openAddFeaturesModal(<?= $productId ?>)">
                Add Features
            </button>
            <button class="nav-link" id="nav-color-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-color" type="button" role="tab" 
                    aria-controls="nav-color" aria-selected="false" onclick="openAddColorModal(<?= $productId ?>)">
                Add colours
            </button>
            <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-size" type="button" role="tab" 
                    aria-controls="nav-size" aria-selected="false" onclick="openAddSizeModal(<?= $productId ?>)">
                Add sizes
            </button>
            <button class="nav-link" id="nav-offer-tab" data-bs-toggle="tab" 
                    data-bs-target="#nav-offer" type="button" role="tab" 
                    aria-controls="nav-offer" aria-selected="false" onclick="openAddOfferModal(<?= $productId ?>)">
                Add offers
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
                        <button type="button" class="btn btn-primary w-100" onclick="addSpecs()">Add</button>
                    </div>
                </form>
            </div>
            <div id="specsList" class="list-group">
                <!-- Existing specs loaded via AJAX -->
            </div>
        </div>


        <!-- Feature Tab -->
        <div class="tab-pane fade" id="nav-feat" role="tabpanel" aria-labelledby="nav-feat-tab">
            <div class="mb-3">
                <form id="featuresForm" class="row g-3">
                    <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">
                    <div class="col-md-4">
                        <label for="feature_text" class="form-label">Feature Text</label>
                        <input type="text" class="form-control" name="feature_text" id="feature_text" required>
                    </div>
                   
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="addFeature()">Add</button>
                    </div>
                </form>
            </div>
            <div id="featureList" class="list-group">
                <!-- Existing specs loaded via AJAX -->
            </div>
        </div>


         <!-- Colour Tab -->
         <div class="tab-pane fade" id="nav-color" role="tabpanel" aria-labelledby="nav-color-tab">
            <div class="mb-3">
                <form id="colorForm" class="row g-3">
                    <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">
                    <div class="col-md-4">
                        <label for="color" class="form-label">Select color</label>
                        <input type="color" class="form-control" name="color" id="color" required>
                    </div>
                   
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="addColor()">Add</button>
                    </div>
                </form>
            </div>
            <div id="colorList" class="list-group">
                <!-- Existing specs loaded via AJAX -->
            </div>
        </div>

         <!-- size Tab -->
         <div class="tab-pane fade" id="nav-size" role="tabpanel" aria-labelledby="nav-size-tab">
            <div class="mb-3">
                <form id="sizeForm" class="row g-3">
                    <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">
                    <div class="col-md-4">
                        <label for="size" class="form-label">Size</label>
                        <select class="form-control" name="size" id="size" required>
                            <option value="">Select Size</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                   
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="addSize()">Add</button>
                    </div>
                </form>
            </div>
            <div id="sizeList" class="list-group">
                <!-- Existing specs loaded via AJAX -->
            </div>
        </div>

        <!-- Offer Tab -->
            <div class="tab-pane fade" id="nav-offer" role="tabpanel" aria-labelledby="nav-offer-tab">
                <div class="mb-3">
                    <form id="offerForm" class="row g-3">
                        <input type="hidden" name="productId" id="productId" value="<?= $productId ?>">

                        <!-- Offer Percentage -->
                        <div class="col-md-4">
                            <label for="offer" class="form-label">Offer Percentage</label>
                            <input type="text" class="form-control" name="offer" id="offer" required>
                        </div>

                        <!-- Expiry Option -->
                        <div class="col-md-4">
                            <label class="form-label">Does this offer have an expiry?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hasExpiry" id="expiryYes" value="yes" onchange="toggleExpiryDate(true)">
                                <label class="form-check-label" for="expiryYes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hasExpiry" id="expiryNo" value="no" checked onchange="toggleExpiryDate(false)">
                                <label class="form-check-label" for="expiryNo">No</label>
                            </div>
                        </div>

                        <!-- Expiry Date (Hidden by Default) -->
                        <div class="col-md-4" id="expiryDateContainer" style="display: none;">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" name="expiryDate" id="expiryDate">
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100" onclick="addOffer()">Add</button>
                        </div>
                    </form>
                </div>

                <!-- Offer List -->
                <div id="offerList" class="list-group">
                    <!-- Existing offers loaded via AJAX -->
                </div>
            </div>

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

<script>
</script>