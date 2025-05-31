<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Super Simple Item Add Form</h5>
    </div>
    <div class="card-body">
        <?php if (empty($categories)) : ?>
            <div class="alert alert-warning">
                You need to create at least one category before you can add items.
                <a href="<?= site_url('category/create') ?>" class="btn btn-outline-primary btn-sm ms-2">
                    <i class="bi bi-plus"></i> Create Category
                </a>
            </div>
        <?php else : ?>
            <!-- Direct form submission to the test controller which we know works -->
            <form action="<?= site_url('test/process') ?>" method="post">
                <div class="alert alert-info">
                    This is a simplified form that submits to our test controller, which we know works.
                    After submitting, we'll redirect you back to the item page.
                </div>
                
                <!-- Item fields -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= esc($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="price" name="price" value="0.00" min="0" step="0.01" required>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= site_url('item') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit via Test Controller</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
