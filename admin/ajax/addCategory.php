<div class="container card shadow-lg p-4 mt-4">
    <div class="text-center mb-4">
        <h4 class="modal-title fw-bold text-primary">Add Category</h4>
        <p class="text-muted">Fill in the form below to add a category</p>
    </div>
    <form method="post" action="backend/addCategories.php" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="catName" class="form-label fw-semibold">Category Name</label>
            <input 
                type="text" 
                name="catName" 
                id="catName" 
                class="form-control shadow-sm border-primary" 
                placeholder="Enter category name" 
                required>
        </div>
        <div class="form-group mb-3">
            <label for="catImage" class="form-label fw-semibold">Category Image</label>
            <input 
                type="file" 
                name="catImage" 
                id="catImage" 
                class="form-control shadow-sm border-primary"
                accept="image/*" 
                required>
        </div>
        <div class="form-group mb-3">
            <label for="catDescription" class="form-label fw-semibold">Category Description</label>
            <textarea 
                name="catDescription" 
                id="catDescription" 
                class="form-control shadow-sm border-primary" 
                rows="3" 
                placeholder="Enter category description" 
                required></textarea>
        </div>
        <div class="d-grid">
            <button 
                type="submit" 
                class="btn btn-primary btn-lg shadow-sm">
                Add Category
            </button>
        </div>
    </form>
</div>

