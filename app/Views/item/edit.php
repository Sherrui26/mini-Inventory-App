<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Item</h5>
    </div>
    <div class="card-body">

<form action="<?= site_url('test/process') ?>" method="post">
    <!-- Hidden field to indicate this is an edit operation -->
    <input type="hidden" name="edit_operation" value="true">
    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" 
                    id="name" name="name" value="<?= old('name', $item['name']) ?>" required>
                <?php if (isset($validation) && $validation->hasError('name')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('name') ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control <?= isset($validation) && $validation->hasError('description') ? 'is-invalid' : '' ?>" 
                    id="description" name="description" rows="3"><?= old('description', $item['description']) ?></textarea>
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
                            <option value="<?= $category['id'] ?>" <?= old('category_id', $item['category_id']) == $category['id'] ? 'selected' : '' ?>>
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
                        id="quantity" name="quantity" value="<?= old('quantity', $item['quantity']) ?>" min="0" required>
                    <?php if (isset($validation) && $validation->hasError('quantity')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('quantity') ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('price') ? 'is-invalid' : '' ?>" 
                        id="price" name="price" value="<?= old('price', $item['price']) ?>" min="0" step="0.01" required>
                    <?php if (isset($validation) && $validation->hasError('price')) : ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('price') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= site_url('item') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Item</button>
            </div>
        </form>
    </div>
</div>
