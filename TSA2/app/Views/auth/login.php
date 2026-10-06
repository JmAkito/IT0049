<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="login-section">
    <div class="login-card">
        <div class="login-heading">
            <p class="eyebrow">STAFF ACCESS</p>
            <h1>Welcome back</h1>
            <p>Log in to create, edit, and archive tasks.</p>
        </div>

        <?php if (session()->has('success')): ?>
            <div class="success-message">
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

        <form action="<?= site_url('/login') ?>" method="post" class="login-form">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= old('username') ?>"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="button button-full">
                Log In
            </button>
        </form>

        <a href="<?= site_url('/tasks') ?>" class="back-link">
            ← Return to public task list
        </a>
    </div>
</section>

<?= $this->endSection() ?>