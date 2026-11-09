<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>POS Dashboard</h1>
<p>Welcome to your Point-of-Sale system.</p>

<div class="stats">
    <section class="card">
        <div>Products</div>
        <p class="stat-number"><?= esc($productCount) ?></p>
    </section>

    <section class="card">
        <div>Customers</div>
        <p class="stat-number"><?= esc($customerCount) ?></p>
    </section>

    <section class="card">
        <div>Staff accounts</div>
        <p class="stat-number"><?= esc($staffCount) ?></p>
    </section>

    <section class="card">
        <div>Recorded sales</div>
        <p class="stat-number"><?= esc($saleCount) ?></p>
    </section>
</div>

<?= $this->endSection() ?>