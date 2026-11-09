<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1>Products</h1>
        <p>Manage product names, prices, stock, and images.</p>
    </div>

    <a class="button" href="<?= site_url('products/new') ?>">Add Product</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="notice success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif ?>

<div class="card table-card">
    <?php if (empty($products)): ?>
        <p>No products yet. Select <strong>Add Product</strong> to create your first one.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <?php if (! empty($product['image'])): ?>
                                    <img
                                        class="product-thumbnail"
                                        src="<?= esc(base_url('uploads/products/' . rawurlencode($product['image']))) ?>"
                                        alt="<?= esc($product['name']) ?>"
                                    >
                                <?php else: ?>
                                    <span class="no-image">No image</span>
                                <?php endif ?>
                            </td>
                            <td><?= esc($product['name']) ?></td>
                            <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                            <td><?= esc($product['stock_quantity']) ?></td>
                            <td class="actions">
                                <a
                                    class="button secondary"
                                    href="<?= site_url('products/' . $product['id'] . '/edit') ?>"
                                >Edit</a>

                                <form
                                    action="<?= site_url('products/' . $product['id'] . '/delete') ?>"
                                    method="post"
                                    onsubmit="return confirm('Delete this product?')"
                                >
                                    <?= csrf_field() ?>
                                    <button class="button danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>