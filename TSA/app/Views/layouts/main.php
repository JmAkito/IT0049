<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A basic Point-of-Sale account management application built with CodeIgniter 4.">
    <title><?= esc($title) ?> | SwiftPOS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <header class="site-header">
        <nav class="nav container" aria-label="Main navigation">
            <a class="brand" href="<?= site_url('/') ?>">Swift<span>POS</span></a>
            <div class="nav-links">
                <a class="<?= $page === 'home' ? 'active' : '' ?>" href="<?= site_url('/') ?>">Home</a>
                <a class="<?= $page === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                <a class="<?= $page === 'customers' ? 'active' : '' ?>" href="<?= site_url('customers') ?>">Customers</a>
                <a class="<?= $page === 'users' ? 'active' : '' ?>" href="<?= site_url('users') ?>">Users</a>
            </div>
        </nav>
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer">
        <div class="container">SwiftPOS &copy; <?= date('Y') ?>. CodeIgniter POS Foundations.</div>
    </footer>
</body>
</html>
