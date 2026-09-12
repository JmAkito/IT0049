<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">POINT OF SALE FOUNDATION</p>
            <h1>Manage your store accounts in one clear place.</h1>
            <p class="lead">SwiftPOS is a starter account-management interface built with CodeIgniter 4 and the MVC architecture.</p>
            <div class="actions">
                <a class="button primary" href="<?= site_url('customers') ?>">View customers</a>
                <a class="button secondary" href="<?= site_url('users') ?>">View staff users</a>
            </div>
        </div>
        <div class="summary-card">
            <p class="card-label">SYSTEM OVERVIEW</p>
            <div class="metric"><strong>5</strong><span>Customer records</span></div>
            <div class="metric"><strong>5</strong><span>User records</span></div>
            <div class="metric"><strong>4</strong><span>Working pages</span></div>
        </div>
    </div>
</section>
<section class="container feature-section">
    <h2>Core modules</h2>
    <div class="cards">
        <article class="card"><span class="icon">C</span><h3>Customer Accounts</h3><p>Review customer names, email addresses, and contact numbers.</p><a href="<?= site_url('customers') ?>">Open customer list &rarr;</a></article>
        <article class="card"><span class="icon">U</span><h3>User Accounts</h3><p>Review staff usernames, full names, and assigned store roles.</p><a href="<?= site_url('users') ?>">Open user list &rarr;</a></article>
        <article class="card"><span class="icon">i</span><h3>About SwiftPOS</h3><p>Learn how routes, controllers, views, and static arrays work together.</p><a href="<?= site_url('about') ?>">Learn more &rarr;</a></article>
    </div>
</section>
<?= $this->endSection() ?>
