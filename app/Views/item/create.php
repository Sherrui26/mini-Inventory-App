<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Add New Item</h5>
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

<form action="<?= site_url('test/process') ?>" method="post">
                <?= csrf_field() ?>

                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" 
                        id="name" name="name" value="<?= old('name') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('name')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('name') ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control <?= isset($validation) && $validation->hasError('description') ? 'is-invalid' : '' ?>" 
                        id="description" name="description" rows="3"><?= old('description') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('description')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('description') ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select <?= isset($validation) && $validation->hasError('category_id') ? 'is-invalid' : '' ?>" 
                            id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($validation) && $validation->hasError('category_id')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('category_id') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control <?= isset($validation) && $validation->hasError('quantity') ? 'is-invalid' : '' ?>" 
                            id="quantity" name="quantity" value="<?= old('quantity', 0) ?>" min="0" required>
                        <?php if (isset($validation) && $validation->hasError('quantity')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('quantity') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" class="form-control <?= isset($validation) && $validation->hasError('price') ? 'is-invalid' : '' ?>" 
                            id="price" name="price" value="<?= old('price', 0.00) ?>" min="0" step="0.01" required>
                        <?php if (isset($validation) && $validation->hasError('price')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= site_url('item') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.querySelector('form');
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent default form submission
                        console.log('Form submission intercepted');
                        
                        // Collect form data
                        const formData = new FormData(form);
                        console.log('Form data collected:');
                        for (let pair of formData.entries()) {
                            console.log(pair[0] + ': ' + pair[1]);
                        }
                        
                        // Manual submission
                        fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (response.ok) {
                                window.location.href = '<?= site_url('item') ?>';
                            } else {
                                console.error('Form submission failed');
                                alert('Form submission failed. See console for details.');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('An error occurred during form submission.');
                        });
                    });
                });
                </script>
            </form>
        <?php endif; ?>
    </div>
</div>
