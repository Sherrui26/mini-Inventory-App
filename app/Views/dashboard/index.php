<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Items</h6>
                        <h2 class="card-text"><?= $totalItems ?></h2>
                    </div>
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
                <a href="<?= site_url('item') ?>" class="text-white">View all items <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Categories</h6>
                        <h2 class="card-text"><?= $totalCategories ?></h2>
                    </div>
                    <i class="bi bi-tags fs-1"></i>
                </div>
                <a href="<?= site_url('category') ?>" class="text-white">View all categories <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Inventory Value</h6>
                        <h2 class="card-text">$<?= number_format($totalValue, 2) ?></h2>
                    </div>
                    <i class="bi bi-currency-dollar fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Inventory by Category</h5>
            </div>
            <div class="card-body">
                <?php if (empty($categories)) : ?>
                    <div class="alert alert-info">
                        No categories found. <a href="<?= site_url('category/create') ?>">Create a category</a> to get started.
                    </div>
                <?php else : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Items</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= esc($category['name']) ?></td>
                                    <td><?= isset($itemsByCategory[$category['id']]) ? $itemsByCategory[$category['id']]['count'] : 0 ?></td>
                                    <td>$<?= isset($itemsByCategory[$category['id']]) ? number_format($itemsByCategory[$category['id']]['value'], 2) : '0.00' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Low Stock Items</h5>
                <span class="badge bg-danger"><?= count($lowStockItems) ?></span>
            </div>
            <div class="card-body">
                <?php if (empty($lowStockItems)) : ?>
                    <div class="alert alert-success">
                        No items are low in stock.
                    </div>
                <?php else : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lowStockItems as $item) : ?>
                                <tr>
                                    <td><?= esc($item['name']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $item['quantity'] === 0 ? 'danger' : 'warning' ?>">
                                            <?= $item['quantity'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('item/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Update
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="d-grid gap-2 d-md-flex">
            <a href="<?= site_url('item/create') ?>" class="btn btn-primary me-md-2">
                <i class="bi bi-plus-circle"></i> Add New Item
            </a>
            <a href="<?= site_url('category/create') ?>" class="btn btn-outline-primary">
                <i class="bi bi-folder-plus"></i> Add New Category
            </a>
        </div>
    </div>
</div>
