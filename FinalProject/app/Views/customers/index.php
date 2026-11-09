<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <h1>Customers</h1>
        <p>Manage customer names and contact information.</p>
    </div>

    <a class="button" href="<?= site_url('customers/new') ?>">Add Customer</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="notice success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif ?>

<div class="card table-card">
    <?php if (empty($customers)): ?>
        <p>No customers yet. Select <strong>Add Customer</strong> to create one.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= esc($customer['full_name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone'] ?? '') ?: '—' ?></td>
                            <td class="actions">
                                <a
                                    class="button secondary"
                                    href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>"
                                >Edit</a>

                                <form
                                    action="<?= site_url('customers/' . $customer['id'] . '/delete') ?>"
                                    method="post"
                                    onsubmit="return confirm('Delete this customer?')"
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