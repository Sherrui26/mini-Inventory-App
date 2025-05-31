<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Inventory Items</h5>
        <a href="<?= site_url('item/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Add Item
        </a>
    </div>
    <div class="card-body">
        <?php if (empty($items)) : ?>
            <div class="alert alert-info">
                No items found. Add a new item to get started.
            </div>
        <?php else : ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $index => $item) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <strong><?= esc($item['name']) ?></strong>
                                <?php if (!empty($item['description'])): ?>
                                    <small class="d-block text-muted"><?= esc($item['description']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['category_name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>
                                <a href="<?= site_url('item/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="<?= site_url('item/delete/' . $item['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">
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
