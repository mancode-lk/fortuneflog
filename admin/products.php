<?php include "layout/header.php"; ?>

<div class="main-content app-content">
    <div class="container-fluid">
        <div class="row" id="user-profile">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="container">
                            <button class="btn btn-sm btn-success" onClick="openModelAddProducts()">Add Products</button>
                        </div>
                    </div>
                    <div id="view_products"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Images</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Age</th>
                                        <th>Type</th>
                                        <th>More details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlProducts = "SELECT * FROM tbl_products";
                                    $rsProducts = $conn->query($sqlProducts);

                                    if ($rsProducts->num_rows > 0) {
                                        while ($rowProduct = $rsProducts->fetch_assoc()) {
                                            $productId = $rowProduct['p_id'];
                                            $productTitle = htmlspecialchars($rowProduct['p_title']);
                                            $productDescription = htmlspecialchars($rowProduct['p_description']);
                                            $productPrice = number_format($rowProduct['p_price'], 2);
                                            $productAge = intval($rowProduct['p_age']);
                                            $productType = $rowProduct['p_type'] == 1 ? "Antique" : "Retro";
                                            $mainImagePath = "uploads/products/" . htmlspecialchars($rowProduct['p_image']);



                                            // Fetch additional images from tbl_images
                                            $sqlImages = "SELECT * FROM tbl_images WHERE product_id = $productId";
                                            $rsImages = $conn->query($sqlImages);
                                    ?>
                                            <tr>
                                                <td><?= $productTitle ?></td>
                                                <td>
                                                    <?php if (!empty($rowProduct['p_image'])) { ?>
                                                        <img src="<?= $mainImagePath ?>" alt="Image" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 5px; cursor: pointer;"
                                                            data-bs-toggle="modal" data-bs-target="#imageModal"
                                                            data-bs-image-id="<?= $productId ?>"
                                                            data-bs-image-path="<?= $mainImagePath ?>"
                                                            data-bs-main-image="1">
                                                    <?php }  else { ?>
                                                        <button class="btn btn-sm btn-warning mt-2" onclick="openAddImagesModal(<?= $productId ?>)">Update Image</button>
                                                    <?php } ?>

                                                    <!-- Display Additional Images -->
                                                    <div class="mt-2">
                                                        <?php while ($image = $rsImages->fetch_assoc()) { ?>
                                                            <img src="uploads/products_more_images/<?= htmlspecialchars($image['image_path']) ?>" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 5px; cursor: pointer;"
                                                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                                                data-bs-image-id="<?= $image['image_id'] ?>"
                                                                data-bs-image-path="uploads/products_more_images/<?= htmlspecialchars($image['image_path']) ?>">
                                                        <?php } ?>
                                                    </div>

                                                    <!-- Button to Add More Images -->
                                                    <button class="btn btn-sm btn-primary mt-2" onclick="openAddMoreImagesModal(<?= $productId ?>)">Add More Images</button>
                                                </td>
                                                <td><?= $productDescription ?></td>
                                                <td>$<?= $productPrice ?></td>
                                                <td><?= $productAge ?>+</td>
                                                <td><?= $productType ?></td>

                                                <td>
                                                    <!-- Display Features -->
                                                    <?php if (!empty($features)) { ?>
                                                        <ul>
                                                            <?php foreach ($features as $feature) { ?>
                                                                <li><?= $feature ?>  <button class="btn btn-sm btn-danger"
                                                                onclick="deleteFeature(<?= $featureId ?>)">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button></li>

                                                            <?php } ?>
                                                        </ul>
                                                    <?php } else { ?>
                                                        <p>No features added</p>
                                                    <?php } ?>

                                                    <!-- Button to Add/Edit Features -->
                                                    <button class="btn btn-sm btn-primary" onclick="openAddFeaturesModal(<?= $productId ?>)">Add Features</button>
                                                </td>
                                                <td><button class="btn btn-sm btn-primary" onclick="openAddMoreDetailsModal(<?= $productId ?>)">Add More Details</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning"
                                                            onclick="openModalEditProduct(<?= $productId ?>, '<?= $productTitle ?>', '<?= $productDescription ?>', <?= $rowProduct['p_price'] ?>, <?= $productAge ?>, <?= $rowProduct['p_type'] ?>)"
                                                            >Edit</button>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(<?= $productId ?>, '<?= $productTitle ?>')">Delete</button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No Products Found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 mb-3" id="add_category">
                      <form method="post" action="backend/addProduct.php" enctype="multipart/form-data">
                        <input type="hidden" id="edit_product_id" name="product_id" value="">
                          <div class="form-group mb-3">
                              <label for="pTitle" class="form-label fw-semibold">Product Title</label>
                              <input
                                  type="text"
                                  name="pTitle"
                                  id="edit_pTitle"
                                  class="form-control shadow-sm border-primary"
                                  placeholder="Enter product title"
                                  required>
                          </div>
                          <div class="form-group mb-3">
                              <label for="pDescription" class="form-label fw-semibold">Product Description</label>
                              <textarea
                                  name="pDescription"
                                  id="edit_pDescription"
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
                                  id="edit_pPrice"
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
                                  id="edit_pAge"
                                  class="form-control shadow-sm border-primary"
                                  placeholder="Enter age suitability"
                                  required>
                          </div>
                          <div class="form-group mb-3">
                              <label for="pType" class="form-label fw-semibold">Product Type</label>
                              <select
                                  name="pType"
                                  id="edit_pType"
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal for Enlarging Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Enlarged Image -->
                <img src="" alt="Preview" id="modalImage" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
            </div>
            <div class="modal-footer">
                <!-- Delete Button -->
                <form action="backend/delete_image.php" method="post" id="deleteImageForm">
                    <input type="hidden" name="image_id" id="modalImageId">
                    <input type="hidden" name="image_path" id="modalImagePath">
                    <input type="hidden" name="is_main_image" id="modalIsMainImage">
                    <button type="submit" class="btn btn-danger">Delete Image</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 mb-3" id="add_category">
                        <!-- Additional dynamic content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add More Images Modal -->
<div class="modal fade" id="addMoreImagesModal" tabindex="-1" aria-labelledby="addMoreImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMoreImagesModalLabel">Add More Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMoreImagesForm" action="backend/addMoreImages.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="addMoreImagesProductId">
                    <div class="mb-3">
                        <label for="productImages" class="form-label">Upload Images</label>
                        <input type="file" name="productImages[]" id="productImages" class="form-control" accept="image/*" multiple required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Images</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Features Modal
<div class="modal fade" id="addFeaturesModal" tabindex="-1" aria-labelledby="addFeaturesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFeaturesModalLabel">Add/Edit Features</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addFeaturesForm" action="backend/addFeatures.php" method="POST">
                    <input type="hidden" name="product_id" id="addFeaturesProductId">
                    <div class="mb-3">
                        <label for="featureText" class="form-label">Feature Text</label>
                        <textarea name="feature_text" id="featureText" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Feature</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="addMoreDetailsModal" tabindex="-1" aria-labelledby="addMoreDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>
</div>

<!-- Add Images Modal -->
<div class="modal fade" id="addImagesModal" tabindex="-1" aria-labelledby="addImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addImagesModalLabel">Update Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addImagesForm" action="backend/addImages.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="addImagesProductId">
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Upload New Image</label>
                        <input type="file" name="productImages" id="productImage" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>


<script>

function openModalEditProduct(productId, productTitle, productDescription, productPrice, productAge, productType) {

    $('#editProductModal').modal('show');

    document.getElementById("edit_product_id").value = productId;
    document.getElementById("edit_pTitle").value = productTitle;
    document.getElementById("edit_pDescription").value = productDescription;
    document.getElementById("edit_pPrice").value = productPrice;
    document.getElementById("edit_pAge").value = productAge;
    document.getElementById("edit_pType").value = productType;
}

function openAddMoreImagesModal(productId) {
    document.getElementById('addMoreImagesProductId').value = productId;
    var addMoreImagesModal = new bootstrap.Modal(document.getElementById('addMoreImagesModal'));
    addMoreImagesModal.show();
}

function openAdvanceDetail(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#getAdvanceList').load('ajax/getAdvanceList.php', { productId: productId });
}

function openAdditionalInfo(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#specsList').load('ajax/getSpecsList.php', { productId: productId });
}

function openAddFeaturesModal(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#featureList').load('ajax/getFeatureList.php', { productId: productId });
}

function openAddColorModal(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#colorList').load('ajax/getColorList.php', { productId: productId });
}

function openAddSizeModal(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#sizeList').load('ajax/getSizeList.php', { productId: productId });
}

function openAddOfferModal(productId){
    $('#addMoreDetailsModal.modal-content').load('ajax/addMoreDetails.php', { productId: productId });
    $('#offerList').load('ajax/getOfferList.php', { productId: productId });
}

function openAddMoreDetailsModal(productId) {
    // Load content into modal

    $('#addMoreDetailsModal .modal-content').load('ajax/addMoreDetails.php', {productId: productId}, function() {
        // Initialize tabs after content loads
        $('#getAdvanceList').load('ajax/getAdvanceList.php', { productId: productId });
        const tabTriggerList = [].slice.call(this.querySelectorAll('[data-bs-toggle="tab"]'));
        tabTriggerList.forEach(tabTriggerEl => new bootstrap.Tab(tabTriggerEl));

        // Load existing details
        loadExistingDetails(productId);
    });

    $('#addMoreDetailsModal').modal('show');
}

function loadExistingDetails(productId) {
    // Load existing advance details
    $('#featuresList').load('../backend/getAdvanceDetails.php', {productId: productId});

    // Load existing specifications
    $('#specsList').load('../backend/getSpecifications.php', {productId: productId});
}
function openAddImagesModal(productId) {
    document.getElementById('addImagesProductId').value = productId;
    var addImagesModal = new bootstrap.Modal(document.getElementById('addImagesModal'));
    addImagesModal.show();
}

// function openAddFeaturesModal(productId) {
//     document.getElementById('addFeaturesProductId').value = productId;
//     var addFeaturesModal = new bootstrap.Modal(document.getElementById('addFeaturesModal'));
//     addFeaturesModal.show();
// }

document.addEventListener("DOMContentLoaded", function () {
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const modalImageId = document.getElementById("modalImageId");
    const modalImagePath = document.getElementById("modalImagePath");
    const modalIsMainImage = document.getElementById("modalIsMainImage");

    document.querySelectorAll("[data-bs-toggle='modal'][data-bs-target='#imageModal']").forEach(img => {
        img.addEventListener("click", function () {
            const imagePath = this.getAttribute("data-bs-image-path");
            const imageId = this.getAttribute("data-bs-image-id");
            const isMainImage = this.hasAttribute("data-bs-main-image") ? "1" : "0";

            // Set the modal image source
            modalImage.setAttribute("src", imagePath);
            // Set hidden input values for the delete form
            modalImageId.value = imageId;
            modalImagePath.value = imagePath;
            modalIsMainImage.value = isMainImage;
        });
    });
});

function openModelAddProducts() {
    $('#showModal').modal('show');
    $('#add_category').load('ajax/addProducts.php');

}

function deleteProduct(productId, productTitle) {
        // Confirm with the user before deleting
        if (confirm("Are you sure you want to delete the product: " + productTitle + "?")) {
            // Make an AJAX request to delete the product and all related data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/deleteProduct.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    if (response == "success") {
                        // Refresh the page or remove the row from the table
                        alert("Product deleted successfully!");
                        window.location.reload(); // You can also use this to remove the row dynamically
                    } else {
                        alert("Error: " + response);
                    }
                }
            };
            xhr.send("product_id=" + productId);
        }
    }


    function deleteFeature(featureId) {
        alert(featureId)
    if (confirm("Are you sure you want to delete this feature?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/deleteFeature.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = xhr.responseText.trim();
                if (response === "success") {
                    // Better to remove the element instead of reloading
                    const element = document.querySelector(`li button[onclick*="${featureId}"]`).closest('li');
                    element.remove();
                } else {
                    alert(`Error: ${response}`);
                }
            } else {
                alert("Request failed with status: " + xhr.status);
            }
        };

        xhr.onerror = function() {
            alert("Request failed");
        };

        xhr.send("feature_id=" + encodeURIComponent(featureId));
    }
}



function addProduct() {
    // Retrieve form values
    var productId = document.getElementById("productId").value;
    var desc = document.getElementById("desc").value;
    var heading = document.getElementById("heading").value;

    // Validate input values
    if (!heading || !desc) {
        alert("Both Heading and Description are required.");
        return;
    }

    // AJAX request
    $.ajax({
        type: 'POST',
        url: 'backend/addAdvanceDetail.php',
        data: {
            productId: productId, // PHP expects this parameter
            desc: desc,
            heading: heading
        },
        dataType: 'json', // Expecting JSON response from backend
        success: function(response) {
            if (response.success) {
                loadExistingDetails(productId); // Reload existing details
                $('#getAdvanceList').load('ajax/getAdvanceList.php', { productId: productId }); // Refresh details list
                $('#advanceDetailForm')[0].reset(); // Reset the form
            } else {
                alert(response.message); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}

function deleteDetail(adId, productId) {
    // alert(productId);
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteAdvanceDetail.php",
            data: { ad_id: adId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId);
                        $('#getAdvanceList').load('ajax/getAdvanceList.php', { productId: productId });
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}



function addSpecs() {
    // Retrieve form values
    var productId = document.getElementById("productId").value;
    var details = document.getElementById("details").value;
    var specs = document.getElementById("specs").value;

    // Validate input values
    if (!details || !specs) {
        alert("Both Specs and Details are required.");
        return;
    }

    // AJAX request
    $.ajax({
        type: 'POST',
        url: 'backend/addSpecs.php',
        data: {
            productId: productId, // PHP expects this parameter
            specs: specs,
            details: details
        },
        dataType: 'json', // Expecting JSON response from backend
        success: function(response) {
            if (response.success) {
                loadExistingDetails(productId); // Reload existing details
                $('#specsList').load('ajax/getSpecsList.php', { productId: productId }); // Refresh details list
                $('#specificationForm')[0].reset(); // Reset the form
            } else {
                alert(response.message); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}

function deleteSpecs(specId, productId) {
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteSpecs.php",
            data: { specId: specId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId); // Reload existing details
                        $('#specsList').load('ajax/getSpecsList.php', { productId: productId }); // Refresh details list
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}


function addFeature() {
    // Retrieve form values
    var productId = document.getElementById("productId").value;
    var feature_text = document.getElementById("feature_text").value;

    // Validate input values
    if (!feature_text) {
        alert("Both Specs and Details are required.");
        return;
    }

    // AJAX request
    $.ajax({
        type: 'POST',
        url: 'backend/addFeatures.php',
        data: {
            productId: productId, // PHP expects this parameter
            feature_text: feature_text
        },
        dataType: 'json', // Expecting JSON response from backend
        success: function(response) {
            if (response.success) {
                loadExistingDetails(productId); // Reload existing details
                $('#featureList').load('ajax/getFeatureList.php', { productId: productId }); // Refresh details list
                $('#featuresForm')[0].reset(); // Reset the form
            } else {
                alert(response.message); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}

function deleteFeature(featureId, productId) {
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteFeature.php",
            data: { featureId: featureId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId); // Reload existing details
                        $('#featureList').load('ajax/getFeatureList.php', { productId: productId }); // Refresh details list
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}


function addColor() {
    // Retrieve form values
    var productId = document.getElementById("productId").value;
    var color = document.getElementById("color").value;

    // Validate input values
    if (!color) {
        alert("colour is required.");
        return;
    }

    // AJAX request
    $.ajax({
        type: 'POST',
        url: 'backend/addColors.php',
        data: {
            productId: productId, // PHP expects this parameter
            color: color
        },
        dataType: 'json', // Expecting JSON response from backend
        success: function(response) {
            if (response.success) {
                loadExistingDetails(productId); // Reload existing details
                $('#colorList').load('ajax/getColorList.php', { productId: productId }); // Refresh details list
                $('#colorForm')[0].reset(); // Reset the form
            } else {
                alert(response.message); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}



function deleteColor(colorId, productId) {
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteColor.php",
            data: { colorId: colorId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId); // Reload existing details
                        $('#colorList').load('ajax/getColorList.php', { productId: productId }); // Refresh details list
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}


function addSize() {
    // Retrieve form values
    var productId = document.getElementById("productId").value;
    var size = document.getElementById("size").value;

    // Validate input values
    if (!size) {
        alert("size is required.");
        return;
    }

    // AJAX request
    $.ajax({
        type: 'POST',
        url: 'backend/addSize.php',
        data: {
            productId: productId, // PHP expects this parameter
            size: size
        },
        dataType: 'json', // Expecting JSON response from backend
        success: function(response) {
            if (response.success) {
                loadExistingDetails(productId); // Reload existing details
                $('#sizeList').load('ajax/getSizeList.php', { productId: productId }); // Refresh details list
                $('#sizeForm')[0].reset(); // Reset the form
            } else {
                alert(response.message); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}



function deleteSize(sizeId, productId) {
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteSize.php",
            data: { sizeId: sizeId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId); // Reload existing details
                        $('#sizeList').load('ajax/getSizeList.php', { productId: productId }); // Refresh details list
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}


function toggleExpiryDate(show) {
    document.getElementById("expiryDateContainer").style.display = show ? "block" : "none";
}

function addOffer() {
    var productId = document.getElementById("productId").value;
    var offer = document.getElementById("offer").value;
    var hasExpiry = document.querySelector('input[name="hasExpiry"]:checked').value;
    var expiryDate = hasExpiry === "yes" ? document.getElementById("expiryDate").value : null;

    if (!offer) {
        alert("Offer percentage is required.");
        return;
    }

    if (hasExpiry === "yes" && !expiryDate) {
        alert("Please enter an expiry date.");
        return;
    }

    $.ajax({
        type: "POST",
        url: "backend/addOffer.php",
        data: {
            productId: productId,
            offer: offer,
            expiryDate: expiryDate
        },
        success: function(response) {
            if (response == 200) {
                loadExistingDetails(productId); // Reload existing details
                $('#offerList').load('ajax/getOfferList.php', { productId: productId }); // Refresh details list
                $('#offerForm')[0].reset(); // Reset the form
            } else {
                alert('somthing went wrong'); // Display failure message
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Log error details for debugging
            alert('Error submitting form. Please try again.');
        }
    });
}



function deleteOffer(offerId, productId) {
    if (confirm("Are you sure you want to delete this detail?")) {
        $.ajax({
            type: "POST",
            url: "backend/deleteOffer.php",
            data: { offerId: offerId },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);

                    if (res.success) {
                        // Reload the modal content and detail list after a successful deletion
                        loadExistingDetails(productId); // Reload existing details
                        $('#offerList').load('ajax/getOfferList.php', { productId: productId }); // Refresh details list
                        // $('#advanceDetailForm')[0].reset(); // Uncomment if needed
                    }
                } catch (e) {
                    console.error("Error parsing JSON response", e);
                    alert('Unexpected response format');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting detail:", error);
                alert("Error deleting detail. Please try again.");
            }
        });
    }
}


</script>
