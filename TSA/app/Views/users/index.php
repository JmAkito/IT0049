<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-heading">
    <div class="container">
        <p class="eyebrow">STAFF DIRECTORY</p>
        <h1>User Accounts</h1>
        <p><?= count($users) ?> user records were retrieved from the MySQL database.</p>

        <a
            href="<?= site_url('users/new') ?>"
            style="display:inline-block; margin-top:15px; padding:10px 16px;
                   background:#075e54; color:white; text-decoration:none;
                   border-radius:6px;"
        >
            Add User
        </a>
    </div>
</section>

<section class="content-section">
    <div class="container">

        <?php if (session()->has('success')): ?>
            <div style="padding:12px; margin-bottom:20px; background:#d4edda;
                        color:#155724; border-radius:6px;">
                <?= esc(session('success')) ?>
            </div>
        <?php endif ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>#</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <?php
                            $avatarPath = ! empty($user['avatar'])
                                ? 'uploads/avatars/' . $user['avatar']
                                : 'assets/images/avatar-placeholder.svg';
                        ?>

                        <tr>
                            <td>
                                <img
                                    src="<?= base_url($avatarPath) ?>"
                                    alt="<?= esc($user['full_name']) ?>"
                                    width="55"
                                    height="55"
                                    style="object-fit:cover; border-radius:50%;"
                                >
                            </td>

                            <td><?= $index + 1 ?></td>

                            <td>
                                <code><?= esc($user['username']) ?></code>
                            </td>

                            <td>
                                <strong><?= esc($user['full_name']) ?></strong>
                            </td>

                            <td>
                                <?= esc(date('M d, Y', strtotime($user['created_at']))) ?>
                            </td>

                            <td>
                                <a
                                    href="<?= site_url('users/' . $user['id'] . '/edit') ?>"
                                    style="display:inline-block; padding:7px 12px;
                                           background:#075e54; color:white;
                                           text-decoration:none; border-radius:5px;"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>