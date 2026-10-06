<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Tasks for Today') ?> | Tasks for Today</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<header class="site-header">
    <nav class="navbar">
        <a href="<?= site_url('/') ?>" class="brand">Tasks for Today</a>

        <div class="nav-links">
            <a href="<?= site_url('/') ?>">Welcome</a>
            <a href="<?= site_url('/tasks') ?>">Task List</a>
            <a href="<?= site_url('/profile') ?>">Profile</a>
            <a href="<?= site_url('/about') ?>">About</a>

            <?php if (session()->get('is_logged_in')): ?>
                <span class="staff-name">
                    <?= esc(session()->get('full_name')) ?>
                </span>

                <a href="<?= site_url('/logout') ?>" class="logout-link">
                    Logout
                </a>
            <?php else: ?>
                <a href="<?= site_url('/login') ?>" class="login-link">
                    Login
                </a>
            <?php endif ?>
        </div>
    </nav>
</header>

<main>
    <?= $this->renderSection('content') ?>
</main>

<footer class="site-footer">
    <p>
        Tasks for Today &copy; <?= date('Y') ?>.
        IT0049 Web System Technologies.
    </p>
</footer>

</body>
</html>