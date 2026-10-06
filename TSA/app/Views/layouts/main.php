<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'SwiftPOS') ?> | SwiftPOS</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<header class="site-header">
    <nav class="navbar">
        <a href="<?= site_url('/') ?>" class="brand">SwiftPOS</a>

        <div class="nav-links">
            <a href="<?= site_url('/') ?>">Home</a>
            <a href="<?= site_url('/about') ?>">About</a>

            <?php if (session()->get('is_logged_in')): ?>
                <a href="<?= site_url('/customers') ?>">Customers</a>
                <a href="<?= site_url('/users') ?>">Users</a>

                <span class="staff-name">
                    <?= esc(session()->get('full_name')) ?>
                </span>

                <a href="<?= site_url('/logout') ?>" class="logout-link">
                    Logout
                </a>
            <?php else: ?>
                <a href="<?= site_url('/login') ?>">Login</a>
            <?php endif ?>
        </div>
    </nav>
</header>

<main>
    <?= $this->renderSection('content') ?>
</main>

<footer class="site-footer">
    <p>SwiftPOS &copy; <?= date('Y') ?>. CodeIgniter POS Foundations.</p>
</footer>

</body>
</html>