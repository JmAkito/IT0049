<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Add New Customer</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="<?= site_url('customers') ?>" method="post">
    <?= csrf_field() ?>

    <div>
        <label for="full_name">Full Name</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= old('full_name') ?>"
        >
    </div>

    <div>
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= old('email') ?>"
        >
    </div>

    <div>
        <label for="phone">Phone</label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="<?= old('phone') ?>"
        >
    </div>

    <br>

    <button type="submit">Save Customer</button>
    <a href="<?= site_url('customers') ?>">Cancel</a>
</form>

<?= $this->endSection() ?>