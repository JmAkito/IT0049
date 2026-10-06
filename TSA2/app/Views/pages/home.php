<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="home-hero">
    <div class="container">
        <p class="eyebrow">TASKS FOR TODAY MANAGEMENT SYSTEM</p>

        <h1>Organize today.<br>Prepare for tomorrow.</h1>

        <p class="hero-text">
            Keep track of important activities using a simple and secure
            CodeIgniter 4 task-management application.
        </p>

        <div class="hero-actions">
            <a href="<?= site_url('/tasks') ?>" class="button">
                View Task List
            </a>

            <?php if (session()->get('is_logged_in')): ?>
                <a href="<?= site_url('/tasks/new') ?>" class="button button-secondary">
                    Add New Task
                </a>
            <?php else: ?>
                <a href="<?= site_url('/login') ?>" class="button button-secondary">
                    Staff Login
                </a>
            <?php endif ?>
        </div>
    </div>
</section>

<section class="home-tasks">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="eyebrow">UPCOMING WORK</p>
                <h2>Active Tasks</h2>
            </div>

            <a href="<?= site_url('/tasks') ?>">View all tasks →</a>
        </div>

        <?php if (empty($tasks)): ?>
            <div class="empty-state">
                <h3>No active tasks</h3>
                <p>There are currently no tasks scheduled.</p>
            </div>
        <?php else: ?>
            <div class="task-grid">
                <?php foreach (array_slice($tasks, 0, 3) as $task): ?>
                    <article class="task-card">
                        <div class="task-date">
                            <?= esc(date('F j, Y', strtotime($task['task_date']))) ?>
                        </div>

                        <h3><?= esc($task['title']) ?></h3>

                        <p>
                            <?= esc($task['description'] ?: 'No description provided.') ?>
                        </p>
                    </article>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</section>

<section class="home-info">
    <div class="container info-grid">
        <article>
            <span>01</span>
            <h3>View Tasks</h3>
            <p>Anyone can view the active task list without logging in.</p>
        </article>

        <article>
            <span>02</span>
            <h3>Manage Securely</h3>
            <p>Only authenticated users can create, edit, or archive tasks.</p>
        </article>

        <article>
            <span>03</span>
            <h3>Archive Safely</h3>
            <p>Tasks are archived through soft deletion instead of being erased.</p>
        </article>
    </div>
</section>

<?= $this->endSection() ?>