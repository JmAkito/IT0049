<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="profile-section">
    <div class="container">
        <div class="profile-card">
            <div class="profile-avatar">JM</div>

            <div class="profile-details">
                <p class="eyebrow">STUDENT PROFILE</p>
                <h1>Jolo Miguel Ambrad</h1>
                <p class="profile-course">
                    IT0049 – Web System Technologies
                </p>

                <p>
                    I created the Tasks for Today Management System as a
                    CodeIgniter 4 project demonstrating database integration,
                    MVC structure, form validation, authentication, sessions,
                    protected routes, and soft deletion.
                </p>

                <div class="profile-tags">
                    <span>CodeIgniter 4</span>
                    <span>PHP</span>
                    <span>MySQL</span>
                    <span>MVC</span>
                    <span>Authentication</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>