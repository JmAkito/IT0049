<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Staff Login</h1>

<?php if (session()->has('success')): ?>
    <div class="success-message login-message">
        <?= esc(session('success')) ?>
    </div>
<?php endif ?>

<?php if (session()->has('login_error')): ?>
    <div class="alert">
        <?= esc(session('login_error')) ?>
    </div>
<?php endif ?>

<?php if (session()->has('errors')): ?>
    <div class="alert">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="<?= site_url('login') ?>" method="post">
    <?= csrf_field() ?>

    <div>
        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= old('username') ?>"
            autocomplete="username"
            autofocus
        >
    </div>

    <div>
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
        >
    </div>

    <button type="submit">Log In</button>
    <a href="<?= site_url('/') ?>">Back to Home</a>
</form>

<?= $this->endSection() ?>