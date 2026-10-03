<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="hero">
    <div class="container hero-grid">

        <div class="hero-copy">
            <p class="eyebrow">POINT OF SALE FOUNDATION</p>

            <h1>Manage your store accounts in one clear place.</h1>

            <p>
                SwiftPOS is a simple account-management application built
                using CodeIgniter 4, MySQL, and the MVC architecture.
            </p>

            <div class="button-row">
                <a class="btn" href="<?= site_url('customers') ?>">
                    View Customers
                </a>

                <a class="btn btn-light" href="<?= site_url('users') ?>">
                    View Users
                </a>
            </div>
        </div>

        <aside class="hero-panel">
            <p class="eyebrow">SYSTEM OVERVIEW</p>

            <h2>SwiftPOS Features</h2>

            <div class="overview-item">
                <strong>Customer Accounts</strong>
                <span>Create, view, and edit customer records.</span>
            </div>

            <div class="overview-item">
                <strong>User Accounts</strong>
                <span>Create and edit staff accounts.</span>
            </div>

            <div class="overview-item">
                <strong>Avatar Upload</strong>
                <span>Upload and prepare user profile pictures.</span>
            </div>

            <div class="overview-item">
                <strong>Form Validation</strong>
                <span>Reject invalid or incomplete information.</span>
            </div>
        </aside>

    </div>
</section>

<section class="content-section">
    <div class="container">

        <div class="section-heading">
            <p class="eyebrow">CORE MODULES</p>
            <h2>Everything needed to manage accounts</h2>
            <p>
                Open a module below to view, create, or update its records.
            </p>
        </div>

        <div class="feature-grid">

            <article class="card">
                <div class="module-icon">C</div>

                <h3>Customer Accounts</h3>

                <p>
                    Review customer names, email addresses, and contact numbers.
                </p>

                <a class="card-link" href="<?= site_url('customers') ?>">
                    Open customer list →
                </a>
            </article>

            <article class="card">
                <div class="module-icon">U</div>

                <h3>User Accounts</h3>

                <p>
                    Review staff accounts, update information, and upload avatars.
                </p>

                <a class="card-link" href="<?= site_url('users') ?>">
                    Open user list →
                </a>
            </article>

            <article class="card">
                <div class="module-icon">i</div>

                <h3>About SwiftPOS</h3>

                <p>
                    Learn how routes, controllers, models, views, and MySQL work together.
                </p>

                <a class="card-link" href="<?= site_url('about') ?>">
                    Learn more →
                </a>
            </article>

        </div>
    </div>
</section>

<?= $this->endSection() ?>