<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1>Sales History</h1>
        <p>Review recorded sales and the staff member who processed each one.</p>
    </div>

    <a class="button" href="<?= site_url('sales/new') ?>">Record a Sale</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="notice success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif ?>

<div class="card table-card">
    <?php if (empty($sales)): ?>
        <p>No sales have been recorded yet.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Staff</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= esc($sale['created_at']) ?></td>
                            <td><?= esc($sale['product_name']) ?></td>
                            <td><?= esc($sale['customer_name']) ?></td>
                            <td><?= esc($sale['staff_name']) ?></td>
                            <td><?= esc($sale['quantity']) ?></td>
                            <td>₱<?= number_format((float) $sale['total_price'], 2) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>