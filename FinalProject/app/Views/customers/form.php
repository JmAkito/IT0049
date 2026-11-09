<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1><?= esc($title) ?></h1>
        <p>Enter the customer’s contact details below.</p>
    </div>

    <a class="button secondary" href="<?= site_url('customers') ?>">Back to Customers</a>
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
    <form action="<?= esc($formAction) ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full name</label>
        <input
            id="full_name"
            name="full_name"
            type="text"
            maxlength="100"
            value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>"
            required
        >

        <label for="email">Email address</label>
        <input
            id="email"
            name="email"
            type="email"
            maxlength="100"
            value="<?= esc(old('email', $customer['email'] ?? '')) ?>"
            required
        >

        <label for="phone">Phone number (optional)</label>
        <input
            id="phone"
            name="phone"
            type="text"
            maxlength="20"
            value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>"
        >

        <div class="form-actions">
            <button class="button" type="submit"><?= esc($buttonText) ?></button>
            <a class="button secondary" href="<?= site_url('customers') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>