<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-hero">
    <div class="container">
        <p class="eyebrow">TASK MANAGEMENT</p>
        <h1>Tasks for Today</h1>
        <p>
            View all active tasks arranged by their scheduled date.
        </p>

        <?php if (session()->get('is_logged_in')): ?>
            <a href="<?= site_url('/tasks/new') ?>" class="button">
                Add New Task
            </a>
        <?php endif ?>
    </div>
</section>

<section class="page-content">
    <div class="container">

        <?php if (session()->has('success')): ?>
            <div class="success-message">
                <?= esc(session('success')) ?>
            </div>
        <?php endif ?>

        <?php if (empty($tasks)): ?>
            <div class="empty-state">
                <h2>No active tasks</h2>
                <p>There are currently no tasks to display.</p>
            </div>
        <?php else: ?>
            <div class="task-grid">
                <?php foreach ($tasks as $task): ?>
                    <article class="task-card">
                        <div class="task-date">
                            <?= esc(date('F j, Y', strtotime($task['task_date']))) ?>
                        </div>

                        <h2><?= esc($task['title']) ?></h2>

                        <p>
                            <?= esc($task['description'] ?: 'No description provided.') ?>
                        </p>

                        <?php if (session()->get('is_logged_in')): ?>
                            <div class="task-actions">
                                <a
                                    href="<?= site_url('/tasks/' . $task['id'] . '/edit') ?>"
                                    class="button button-secondary"
                                >
                                    Edit
                                </a>

                                <form
                                    action="<?= site_url('/tasks/' . $task['id'] . '/archive') ?>"
                                    method="post"
                                    onsubmit="return confirm('Archive this task?');"
                                >
                                    <?= csrf_field() ?>

                                    <button type="submit" class="button button-danger">
                                        Archive
                                    </button>
                                </form>
                            </div>
                        <?php endif ?>
                    </article>
                <?php endforeach ?>
            </div>
        <?php endif ?>

    </div>
</section>

<?= $this->endSection() ?>