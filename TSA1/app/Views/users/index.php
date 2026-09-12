<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-heading"><div class="container"><p class="eyebrow">STAFF DIRECTORY</p><h1>User Accounts</h1><p><?= count($users) ?> staff records are available in the temporary data source.</p></div></section>
<section class="container table-section">
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Username</th><th>Full name</th><th>Role</th></tr></thead>
            <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr><td><?= $index + 1 ?></td><td><code><?= esc($user['username']) ?></code></td><td><strong><?= esc($user['full_name']) ?></strong></td><td><span class="role"><?= esc($user['role']) ?></span></td></tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>
<?= $this->endSection() ?>
