<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1>Record a Sale</h1>
        <p>Choose a product, customer, and quantity. Stock will update when the sale is saved.</p>
    </div>

    <a class="button secondary" href="<?= site_url('sales') ?>">Back to Sales</a>
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

<?php if (empty($products)): ?>
    <div class="notice error">There are no products with stock available. Add stock to a product before recording a sale.</div>
<?php endif ?>

<?php if (empty($customers)): ?>
    <div class="notice error">Add a customer before recording a sale.</div>
<?php endif ?>

<div class="card form-card">
    <form action="<?= site_url('sales') ?>" method="post">
        <?= csrf_field() ?>

        <label for="product_id">Product</label>
        <select id="product_id" name="product_id" required>
            <option value="">Select a product</option>
            <?php foreach ($products as $product): ?>
                <option
                    value="<?= esc($product['id']) ?>"
                    <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
                >
                    <?= esc($product['name']) ?>
                    — ₱<?= number_format((float) $product['price'], 2) ?>
                    (Stock: <?= esc($product['stock_quantity']) ?>)
                </option>
            <?php endforeach ?>
        </select>

        <label for="customer_id">Customer</label>
        <select id="customer_id" name="customer_id" required>
            <option value="">Select a customer</option>
            <?php foreach ($customers as $customer): ?>
                <option
                    value="<?= esc($customer['id']) ?>"
                    <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>
                >
                    <?= esc($customer['full_name']) ?>
                </option>
            <?php endforeach ?>
        </select>

        <label for="quantity">Quantity</label>
        <input
            id="quantity"
            name="quantity"
            type="number"
            min="1"
            step="1"
            value="<?= esc(old('quantity', '1')) ?>"
            required
        >

        <div class="form-actions">
            <button
                class="button"
                type="submit"
                <?= empty($products) || empty($customers) ? 'disabled' : '' ?>
            >Save Sale</button>
            <a class="button secondary" href="<?= site_url('sales') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>