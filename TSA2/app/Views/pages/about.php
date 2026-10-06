<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="about-hero">
    <div class="about-container">
        <p class="about-label">ABOUT THE PROJECT</p>

        <h1>A secure task-management system built with CodeIgniter 4.</h1>

        <p class="about-intro">
            Tasks for Today is a database-backed web application that allows
            visitors to view active tasks while requiring authentication for
            task-management actions.
        </p>
    </div>
</section>

<section class="about-content">
    <div class="about-container">
        <div class="about-heading">
            <p class="about-label">HOW IT WORKS</p>
            <h2>Public viewing and protected management</h2>

            <p>
                Welcome, Task List, Profile, and About are available to
                everyone. Creating, editing, and archiving tasks requires
                a valid staff session.
            </p>
        </div>

        <div class="mvc-grid">
            <article class="mvc-card">
                <span class="mvc-number">01</span>
                <h3>Database</h3>
                <p>
                    MySQL stores user accounts and task records, including
                    task dates and archive status.
                </p>
            </article>

            <article class="mvc-card">
                <span class="mvc-number">02</span>
                <h3>Authentication</h3>
                <p>
                    Passwords are securely hashed and verified before a user
                    session is created.
                </p>
            </article>

            <article class="mvc-card">
                <span class="mvc-number">03</span>
                <h3>Soft Deletion</h3>
                <p>
                    Archiving changes the task status instead of permanently
                    deleting its database record.
                </p>
            </article>
        </div>

        <div class="about-features">
            <div>
                <p class="about-label">SYSTEM FEATURES</p>
                <h2>Included in TSA2</h2>
            </div>

            <ul class="feature-list">
                <li>Public Welcome, Task List, Profile, and About pages</li>
                <li>Validated New Task and Edit Task forms</li>
                <li>Secure login and logout</li>
                <li>Session-based authentication</li>
                <li>Protected task-management routes</li>
                <li>Password hashing and verification</li>
                <li>Soft deletion using an archive flag</li>
                <li>Archived tasks excluded from public pages</li>
            </ul>
        </div>
    </div>
</section>

<?= $this->endSection() ?>