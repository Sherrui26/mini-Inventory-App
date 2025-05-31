<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Add New Category</h5>
    </div>
    <div class="card-body">

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
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= site_url('category') ?>" class="btn btn-secondary me-md-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</div>
