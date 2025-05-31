<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Categories</h5>
        <a href="<?= site_url('category/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Add Category
        </a>
    </div>
    <div class="card-body">
        <?php if (empty($categories)) : ?>
            <div class="alert alert-info">
                No categories found. Create a new category to get started.
            </div>
        <?php else : ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $index => $category) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($category['name']) ?></td>
                            <td><?= esc($category['description'] ?? 'N/A') ?></td>
                            <td><?= date('M d, Y', strtotime($category['created_at'])) ?></td>
                            <td>
                                <a href="<?= site_url('category/edit/' . $category['id']) ?>" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="<?= site_url('category/delete/' . $category['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
