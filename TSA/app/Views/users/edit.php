<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Edit User</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if (! empty($user['avatar'])): ?>
    <p>Current Avatar:</p>
    <img
        src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>"
        alt="<?= esc($user['full_name']) ?>"
        width="120"
        height="120"
        style="object-fit: cover; border-radius: 50%;"
    >
<?php endif ?>

<form
    action="<?= site_url('users/' . $user['id'] . '/update') ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <div>
        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= old('username', $user['username']) ?>"
        >
    </div>

    <div>
        <label for="full_name">Full Name</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= old('full_name', $user['full_name']) ?>"
        >
    </div>

    <div>
        <label for="avatar">Profile Picture</label>
        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >
        <p>JPG or PNG only. Maximum size: 2 MB.</p>
    </div>

    <br>

    <button type="submit">Update User</button>
    <a href="<?= site_url('users') ?>">Cancel</a>
</form>

<?= $this->endSection() ?>