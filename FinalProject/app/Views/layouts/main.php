<?php
$displayName = session()->get('full_name')
    ?? session()->get('username')
    ?? 'User';

$initial = strtoupper(substr(trim($displayName), 0, 1));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'POS System') ?> | FinalProject POS</title>

    <style>
        :root {
            --navy: #172033;
            --navy-light: #202b43;
            --page: #f4f6fa;
            --white: #fff;
            --text: #202a3c;
            --muted: #778198;
            --line: #e6eaf1;
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-soft: #eeedff;
            --green: #15803d;
            --green-soft: #eaf8ef;
            --red: #c24141;
            --red-soft: #fff0f0;
            --shadow: 0 12px 32px rgba(23, 32, 51, .06);
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            background: var(--page);
            color: var(--text);
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            font-size: 14px;
        }

        a { color: inherit; }

        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 5;
            display: flex;
            width: 250px;
            flex-direction: column;
            padding: 25px 16px 18px;
            background: var(--navy);
            color: #d6dbea;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 8px 38px;
            color: #fff;
            text-decoration: none;
        }

        .brand-mark {
            display: grid;
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            place-items: center;
            border-radius: 13px;
            background: linear-gradient(135deg, #7770ff, #4f46e5);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .5px;
            box-shadow: 0 6px 16px rgba(79, 70, 229, .32);
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            gap: 3px;
            font-size: 15px;
            font-weight: 700;
        }

        .brand-copy small {
            color: #8f9ab0;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .nav-heading {
            margin: 0 12px 10px;
            color: #8691a7;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-nav a {
            display: flex;
            min-height: 44px;
            align-items: center;
            gap: 13px;
            padding: 0 12px;
            border-radius: 9px;
            color: #b9c2d3;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        .sidebar-nav a.nav-primary {
            margin-top: 10px;
            background: var(--primary);
            color: #fff;
        }

        .sidebar-nav a.nav-primary:hover { background: var(--primary-dark); }

        .nav-icon {
            display: grid;
            width: 22px;
            flex: 0 0 22px;
            place-items: center;
            color: #9fa9bd;
            font-size: 17px;
            line-height: 1;
        }

        .nav-primary .nav-icon { color: #fff; }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 7px 14px;
        }

        .user-initial {
            display: grid;
            width: 37px;
            height: 37px;
            flex: 0 0 37px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 50%;
            background: #303b54;
            color: #fff;
            font-weight: 700;
        }

        .user-details {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 4px;
        }

        .user-details strong {
            overflow: hidden;
            color: #fff;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-details span {
            color: #8f9ab0;
            font-size: 11px;
        }

        .logout-link {
            display: block;
            padding: 9px 10px;
            border-radius: 8px;
            color: #c4ccda;
            font-size: 12px;
            text-decoration: none;
        }

        .logout-link:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        /* Main area */

        .app-main {
            display: flex;
            min-width: 0;
            min-height: 100vh;
            flex: 1;
            flex-direction: column;
            margin-left: 250px;
        }

        .topbar {
            display: flex;
            min-height: 76px;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 38px;
            border-bottom: 1px solid var(--line);
            background: var(--white);
        }

        .topbar-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .system-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #667188;
            font-size: 12px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #24a36b;
            box-shadow: 0 0 0 3px #e8f7ef;
        }

        .quick-sale {
            padding: 10px 14px;
            border-radius: 8px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: background .15s ease;
        }

        .quick-sale:hover { background: #dfddff; }

        .content {
            width: 100%;
            max-width: 1500px;
            flex: 1;
            margin: 0 auto;
            padding: 34px 38px 48px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .page-heading h1 {
            margin: 0 0 7px;
            color: var(--text);
            font-size: 27px;
            font-weight: 750;
            letter-spacing: -.6px;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        /* Buttons and messages */

        .button {
            display: inline-flex;
            min-height: 39px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 15px;
            border: 0;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font: inherit;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
            transition: background .15s ease, transform .15s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            background: var(--primary-dark);
        }

        .button.secondary {
            background: #edf0f6;
            color: #3d4960;
        }

        .button.secondary:hover { background: #e1e6ef; }

        .button.danger {
            background: var(--red-soft);
            color: var(--red);
        }

        .button.danger:hover { background: #ffe1e1; }

        .button:disabled {
            transform: none;
            background: #aab2c1;
            cursor: not-allowed;
        }

        .notice {
            margin: 0 0 18px;
            padding: 14px 16px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 13px;
            line-height: 1.5;
        }

        .notice.success {
            border-color: #ccebd7;
            background: var(--green-soft);
            color: #17633a;
        }

        .notice.error {
            border-color: #f2d1d1;
            background: var(--red-soft);
            color: #912d2d;
        }

        .notice ul { margin-bottom: 0; }

        /* Cards and tables */

        .card {
            padding: 23px;
            border: 1px solid var(--line);
            border-radius: 13px;
            background: var(--white);
            box-shadow: var(--shadow);
        }

        .table-card {
            overflow: hidden;
            padding: 0;
        }

        .table-scroll { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead { background: #fafbfe; }

        th {
            padding: 14px 18px;
            border-bottom: 1px solid var(--line);
            color: #768198;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .9px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid #edf0f5;
            color: #39445a;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr { transition: background .12s ease; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child td { border-bottom: 0; }

        .product-thumbnail, .avatar-thumbnail {
            width: 46px;
            height: 46px;
            border: 1px solid var(--line);
            border-radius: 9px;
            background: #f6f7fb;
            object-fit: cover;
        }

        .avatar-thumbnail { border-radius: 50%; }

        .no-image {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            background: #f0f2f7;
            color: #7e8798;
            font-size: 10px;
            font-weight: 600;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .actions form { margin: 0; }
        .actions .button { min-height: 33px; padding: 0 11px; }

        /* Forms */

        .form-card { max-width: 720px; }

        .form-card label {
            display: block;
            margin: 18px 0 7px;
            color: #39445a;
            font-size: 12px;
            font-weight: 700;
        }

        .form-card input, .form-card select {
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            border: 1px solid #d9deea;
            border-radius: 8px;
            outline: none;
            background: #fff;
            color: var(--text);
            font: inherit;
            font-size: 13px;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .form-card input:focus, .form-card select:focus {
            border-color: #817af2;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, .12);
        }

        .form-card input[type="file"] {
            min-height: 48px;
            padding: 8px;
            background: #fafbfe;
        }

        .form-image-preview {
            display: block;
            width: 110px;
            height: 110px;
            margin-top: 9px;
            border: 1px solid var(--line);
            border-radius: 12px;
            object-fit: cover;
        }

        .current-image-label {
            margin: 16px 0 0;
            color: #536078;
            font-size: 12px;
            font-weight: 700;
        }

        .help-text {
            margin-top: 7px;
            color: var(--muted);
            font-size: 11px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 24px;
        }

        /* Existing dashboard widgets */

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(185px, 1fr));
            gap: 16px;
        }

        .stat-number {
            color: var(--text);
            font-size: 29px;
            font-weight: 750;
        }

        footer {
            padding: 0 38px 22px;
            color: #98a0af;
            font-size: 11px;
        }

        @media (max-width: 1000px) {
            .sidebar { width: 220px; }
            .app-main { margin-left: 220px; }
            .topbar, .content { padding-right: 25px; padding-left: 25px; }
            footer { padding-right: 25px; padding-left: 25px; }
        }

        @media (max-width: 760px) {
            .app-shell { display: block; }

            .sidebar {
                position: static;
                width: 100%;
                padding: 12px 16px;
            }

            .brand { margin: 0 4px 12px; }

            .nav-heading, .sidebar-bottom { display: none; }

            .sidebar-nav {
                flex-direction: row;
                gap: 5px;
                overflow-x: auto;
                padding-bottom: 2px;
            }

            .sidebar-nav a {
                min-height: 38px;
                flex: 0 0 auto;
                gap: 7px;
                padding: 0 10px;
                font-size: 11px;
            }

            .sidebar-nav a.nav-primary { margin-top: 0; }
            .nav-icon { width: auto; flex-basis: auto; font-size: 14px; }

            .app-main { min-height: calc(100vh - 120px); margin-left: 0; }
            .topbar { min-height: 60px; padding: 12px 18px; }
            .content { padding: 25px 18px 38px; }
            footer { padding: 0 18px 18px; }
        }

        @media (max-width: 520px) {
            .topbar { align-items: flex-start; flex-direction: column; gap: 10px; }
            .topbar-right { width: 100%; justify-content: space-between; }
            .page-heading { align-items: flex-start; flex-direction: column; }
            .page-heading h1 { font-size: 24px; }
            .card { padding: 17px; }
            .table-card { padding: 0; }
            th, td { padding: 12px; }
            .actions { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>

<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="<?= site_url('dashboard') ?>">
            <span class="brand-mark">FP</span>
            <span class="brand-copy">
                FinalProject
                <small>POINT OF SALE</small>
            </span>
        </a>

        <div class="nav-heading">WORKSPACE</div>

        <nav class="sidebar-nav" aria-label="Main navigation">
            <a href="<?= site_url('dashboard') ?>">
                <span class="nav-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="<?= site_url('products') ?>">
                <span class="nav-icon">▤</span>
                <span>Products</span>
            </a>

            <a href="<?= site_url('customers') ?>">
                <span class="nav-icon">♙</span>
                <span>Customers</span>
            </a>

            <a href="<?= site_url('staff') ?>">
                <span class="nav-icon">♧</span>
                <span>Staff</span>
            </a>

            <a class="nav-primary" href="<?= site_url('sales/new') ?>">
                <span class="nav-icon">＋</span>
                <span>New Sale</span>
            </a>

            <a href="<?= site_url('sales') ?>">
                <span class="nav-icon">◷</span>
                <span>Sales History</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="user-card">
                <span class="user-initial"><?= esc($initial) ?></span>
                <span class="user-details">
                    <strong><?= esc($displayName) ?></strong>
                    <span>Signed in</span>
                </span>
            </div>

            <a class="logout-link" href="<?= site_url('logout') ?>">↗ &nbsp; Log out</a>
        </div>
    </aside>

    <div class="app-main">
        <header class="topbar">
            <div class="topbar-label">Store management</div>

            <div class="topbar-right">
                <span class="system-status">
                    <span class="status-dot"></span>
                    System ready
                </span>
                <a class="quick-sale" href="<?= site_url('sales/new') ?>">＋ Quick sale</a>
            </div>
        </header>

        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>

        <footer>
            FinalProject POS &nbsp;·&nbsp; Inventory and sales management
        </footer>
    </div>
</div>
</body>
</html>