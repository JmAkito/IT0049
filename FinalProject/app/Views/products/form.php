<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1><?= esc($title) ?></h1>
        <p>Enter the product details below.</p>
    </div>

    <a class="button secondary" href="<?= site_url('products') ?>">Back to Products</a>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<?php if (! empty($errors)): ?>
    <div class="notice error">
        <strong>Please correct these fields:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<div class="card form-card">
    <form action="<?= esc($formAction) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="name">Product name</label>
        <input
            id="name"
            name="name"
            type="text"
            maxlength="100"
            value="<?= esc(old('name', $product['name'] ?? '')) ?>"
            required
        >

        <label for="price">Price (₱)</label>
        <input
            id="price"
            name="price"
            type="number"
            min="0"
            step="0.01"
            value="<?= esc(old('price', $product['price'] ?? '')) ?>"
            required
        >

        <label for="stock_quantity">Stock quantity</label>
        <input
            id="stock_quantity"
            name="stock_quantity"
            type="number"
            min="0"
            step="1"
            value="<?= esc(old('stock_quantity', $product['stock_quantity'] ?? '')) ?>"
            required
        >

        <label for="image">Product image (optional, JPG/PNG/WEBP, max 2 MB)</label>
        <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

        <?php if (! empty($product['image'])): ?>
            <p class="current-image-label">Current image:</p>
            <img
                class="form-image-preview"
                src="<?= esc(base_url('uploads/products/' . rawurlencode($product['image']))) ?>"
                alt="<?= esc($product['name']) ?>"
            >
            <p class="help-text">Leave the image field empty to keep the current image.</p>
        <?php endif ?>

        <div class="form-actions">
            <button class="button" type="submit"><?= esc($buttonText) ?></button>
            <a class="button secondary" href="<?= site_url('products') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>