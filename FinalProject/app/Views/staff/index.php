<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1>Staff</h1>
        <p>Manage the accounts that can sign in to the POS system.</p>
    </div>

    <a class="button" href="<?= site_url('staff/new') ?>">Add Staff Member</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="notice success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif ?>

<div class="card table-card">
    <?php if (empty($staff)): ?>
        <p>No staff accounts were found.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($staff as $member): ?>
                        <tr>
                            <td>
                                <?php if (! empty($member['avatar'])): ?>
                                    <img
                                        class="avatar-thumbnail"
                                        src="<?= esc(base_url('uploads/avatars/' . rawurlencode($member['avatar']))) ?>"
                                        alt="<?= esc($member['full_name']) ?>"
                                    >
                                <?php else: ?>
                                    <span class="no-image">No avatar</span>
                                <?php endif ?>
                            </td>
                            <td><?= esc($member['full_name']) ?></td>
                            <td><?= esc($member['username']) ?></td>
                            <td class="actions">
                                <a
                                    class="button secondary"
                                    href="<?= site_url('staff/' . $member['id'] . '/edit') ?>"
                                >Edit</a>

                                <form
                                    action="<?= site_url('staff/' . $member['id'] . '/delete') ?>"
                                    method="post"
                                    onsubmit="return confirm('Delete this staff account?')"
                                >
                                    <?= csrf_field() ?>
                                    <button class="button danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>