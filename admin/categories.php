
<?php include "layout/header.php";
?>

<div class="main-content app-content">
			<div class="container-fluid">

					<div class="row" id="user-profile">
					<div class="col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
                                <div class="container">
                                    <button class="btn btn-sm btn-success" onClick="openModelAddCategory()">Add Category</button>
                                    
                                </div>
							</div>
							<div id="view_products">

							</div>
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
									<th>Category</th>
									<th>Image</th>
                                    <th>Description</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php
										$sqlCat = "SELECT * FROM tbl_categories";
										$rsCat = $conn->query($sqlCat);

										if ($rsCat->num_rows > 0) {
											while ($rowsCat = $rsCat->fetch_assoc()) {
												$imagePath = "uploads/categories/" . htmlspecialchars($rowsCat['cat_image']);
												$catId = $rowsCat['cat_id'];
												$catName = htmlspecialchars($rowsCat['cat_name']);
												$catDescription = htmlspecialchars($rowsCat['cat_description']);
										?>
												<tr>
													<td><?= $catName ?></td>
													<td>
														<?php if (!empty($rowsCat['cat_image'])) { ?>
															<img src="<?= $imagePath ?>" alt="Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;"
																data-bs-toggle="modal" data-bs-target="#imageModal"
																data-bs-image-id="<?= $catId ?>"
																data-bs-image-path="<?= $imagePath ?>">
														<?php } else { ?>
															<button class="btn btn-sm btn-danger" onclick="addImage(<?= $catId ?>)">Add Image</button>
														<?php } ?>
													</td>
													<td><?= $catDescription ?></td>
													<td>
														<button class="btn btn-sm btn-warning" onclick="openModalEditCategory(<?= $catId ?>, '<?= $catName ?>', '<?= $catDescription ?>')">Edit</button>
														<button class="btn btn-sm btn-danger" onclick="deleteCategory(<?= $catId ?>, '<?= $catName ?>')">Delete</button>
													</td>
												</tr>
										<?php
											}
										} else {
											echo "<tr><td colspan='4'>No Categories found</td></tr>";
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
							<form action="backend/delete_image_cat.php" method="post" id="deleteImageForm">
								<input type="hidden" name="cat_id" id="modalImageId">
								<input type="hidden" name="image_path" id="modalImagePath">
								<button type="submit" class="btn btn-danger">Delete Image</button>
							</form>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	
			<!-- Add Image Modal -->
			<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addImageModalLabel">Upload Category Image</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="backend/add_image.php" method="post" enctype="multipart/form-data">
							<div class="modal-body">
								<input type="hidden" name="cat_id" id="addImageCatId">
								<div class="mb-3">
									<label for="catImageUpload" class="form-label fw-semibold">Select Image</label>
									<input type="file" name="cat_image" id="catImageUpload" class="form-control" accept="image/*" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Upload Image</button>
							</div>
						</form>
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

		<!-- Edit Category Modal -->
			<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="backend/edit_category.php" method="post">
							<div class="modal-body">
								<input type="hidden" name="cat_id" id="editCatId">
								<div class="mb-3">
									<label for="editCatName" class="form-label fw-semibold">Category Name</label>
									<input type="text" name="cat_name" id="editCatName" class="form-control" required>
								</div>
								<div class="mb-3">
									<label for="editCatDescription" class="form-label fw-semibold">Category Description</label>
									<textarea name="cat_description" id="editCatDescription" class="form-control" rows="3" required></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>


		<!-- Delete Confirmation Modal -->
		<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Delete</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete <strong id="deleteCatName"></strong>?</p>
					</div>
					<div class="modal-footer">
						<form action="backend/delete_category.php" method="post">
							<input type="hidden" name="cat_id" id="deleteCatId">
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</div>
				</div>
			</div>
		</div>

	


		<?php include("layout/footer.php"); ?>

        <script>

document.addEventListener("DOMContentLoaded", function () {
    const imageModal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const modalImageId = document.getElementById("modalImageId");
    const modalImagePath = document.getElementById("modalImagePath");

    document.querySelectorAll("[data-bs-toggle='modal'][data-bs-target='#imageModal']").forEach(img => {
        img.addEventListener("click", function () {
            const imagePath = this.getAttribute("data-bs-image-path");
            const catId = this.getAttribute("data-bs-image-id");

            // Set the modal image source
            modalImage.setAttribute("src", imagePath);
            // Set hidden input values for the delete form
            modalImageId.value = catId;
            modalImagePath.value = imagePath;
        });
    });
});


              function openModelAddCategory(){
                $('#showModal').modal('show');
				$('#add_category').load('ajax/addCategory.php');

            }
			
			function addImage(catId) {
				document.getElementById("addImageCatId").value = catId;
				var addImageModal = new bootstrap.Modal(document.getElementById("addImageModal"));
				addImageModal.show();
			}


			function openModalEditCategory(catId, catName, catDescription) {
			document.getElementById("editCatId").value = catId;
			document.getElementById("editCatName").value = catName;
			document.getElementById("editCatDescription").value = catDescription;

			var editModal = new bootstrap.Modal(document.getElementById("editCategoryModal"));
			editModal.show();
		}

		function deleteCategory(catId, catName) {
			document.getElementById("deleteCatId").value = catId;
			document.getElementById("deleteCatName").innerText = catName;

			var deleteModal = new bootstrap.Modal(document.getElementById("deleteCategoryModal"));
			deleteModal.show();
		}



        </script>