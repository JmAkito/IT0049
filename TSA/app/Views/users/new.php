<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Add New User</h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="<?= site_url('users') ?>" method="post">
    <?= csrf_field() ?>

    <div>
        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= old('username') ?>"
        >
    </div>

    <div>
        <label for="full_name">Full Name</label>
        <input
            type="text"
            id="full_name"
            name="full_name"
            value="<?= old('full_name') ?>"
        >
    </div>

    <br>

    <button type="submit">Save User</button>
    <a href="<?= site_url('users') ?>">Cancel</a>
</form>

<?= $this->endSection() ?>