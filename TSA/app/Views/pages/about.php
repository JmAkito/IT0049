<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="about-hero">
    <div class="about-container">
        <p class="about-label">ABOUT THE PROJECT</p>

        <h1>A simple and secure CodeIgniter POS foundation.</h1>

        <p class="about-intro">
            SwiftPOS is a student project that demonstrates how CodeIgniter 4,
            MySQL, MVC, form validation, file uploads, sessions, and
            authentication work together.
        </p>
    </div>
</section>

<section class="about-content">
    <div class="about-container">

        <div class="about-heading">
            <p class="about-label">HOW IT WORKS</p>
            <h2>Built using the MVC structure</h2>
            <p>
                Each browser request passes through a route, controller,
                model, and view before the final page is displayed.
            </p>
        </div>

        <div class="mvc-grid">
            <article class="mvc-card">
                <span class="mvc-number">01</span>
                <h3>Route</h3>
                <p>
                    Matches the requested URL and sends it to the correct
                    controller method.
                </p>
            </article>

            <article class="mvc-card">
                <span class="mvc-number">02</span>
                <h3>Controller</h3>
                <p>
                    Handles the request, validates information, and communicates
                    with the model.
                </p>
            </article>

            <article class="mvc-card">
                <span class="mvc-number">03</span>
                <h3>Model and View</h3>
                <p>
                    The model works with MySQL, while the view displays the
                    prepared information to the user.
                </p>
            </article>
        </div>

        <div class="about-features">
            <div>
                <p class="about-label">CURRENT FEATURES</p>
                <h2>What SwiftPOS can do</h2>
            </div>

            <ul class="feature-list">
                <li>Display customer and staff accounts from MySQL</li>
                <li>Create and edit customer records</li>
                <li>Create and edit user accounts</li>
                <li>Upload and prepare profile pictures</li>
                <li>Validate submitted form information</li>
                <li>Authenticate staff using hashed passwords</li>
                <li>Protect pages using sessions and an authentication filter</li>
            </ul>
        </div>

    </div>
</section>

<?= $this->endSection() ?>