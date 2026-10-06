<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="form-section">
    <div class="form-container">
        <div class="form-heading">
            <p class="eyebrow">TASK MANAGEMENT</p>
            <h1>Edit Task</h1>
            <p>Update the selected task information.</p>
        </div>

        <?php if (session()->has('errors')): ?>
            <div class="alert">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form
            action="<?= site_url('/tasks/' . $task['id'] . '/update') ?>"
            method="post"
            class="task-form"
        >
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="title">Task Title</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    maxlength="150"
                    value="<?= old('title', $task['title']) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    maxlength="1000"
                ><?= old('description', $task['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="task_date">Task Date</label>
                <input
                    type="date"
                    id="task_date"
                    name="task_date"
                    value="<?= old('task_date', $task['task_date']) ?>"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="button">Update Task</button>

                <a href="<?= site_url('/tasks') ?>" class="button button-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>