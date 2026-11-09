<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1><?= esc($title) ?></h1>
        <p>Enter the staff account details below.</p>
    </div>

    <a class="button secondary" href="<?= site_url('staff') ?>">Back to Staff</a>
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

        <label for="full_name">Full name</label>
        <input
            id="full_name"
            name="full_name"
            type="text"
            maxlength="100"
            value="<?= esc(old('full_name', $staffMember['full_name'] ?? '')) ?>"
            required
        >

        <label for="username">Username</label>
        <input
            id="username"
            name="username"
            type="text"
            maxlength="50"
            value="<?= esc(old('username', $staffMember['username'] ?? '')) ?>"
            required
        >

        <label for="password">
            Password <?= $isEditing ? '(leave blank to keep the current password)' : '(at least 8 characters)' ?>
        </label>
        <input
            id="password"
            name="password"
            type="password"
            minlength="8"
            <?= $isEditing ? '' : 'required' ?>
        >

        <label for="avatar">Avatar (optional, JPG or PNG, max 2 MB)</label>
        <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">

        <?php if (! empty($staffMember['avatar'])): ?>
            <p class="current-image-label">Current avatar:</p>
            <img
                class="form-image-preview"
                src="<?= esc(base_url('uploads/avatars/' . rawurlencode($staffMember['avatar']))) ?>"
                alt="<?= esc($staffMember['full_name']) ?>"
            >
            <p class="help-text">Leave the avatar field empty to keep the current image.</p>
        <?php endif ?>

        <div class="form-actions">
            <button class="button" type="submit"><?= esc($buttonText) ?></button>
            <a class="button secondary" href="<?= site_url('staff') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>