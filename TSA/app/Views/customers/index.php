<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-heading">
    <div class="container">
        <p class="eyebrow">ACCOUNT DIRECTORY</p>
        <h1>Customer Accounts</h1>
        <p><?= count($customers) ?> customer records were retrieved from the MySQL database.</p>

        <a
            href="<?= site_url('customers/new') ?>"
            style="display:inline-block; margin-top:15px; padding:10px 16px;
                   background:#075e54; color:white; text-decoration:none;
                   border-radius:6px;"
        >
            Add Customer
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
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($customers as $index => $customer): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>

                            <td>
                                <strong><?= esc($customer['full_name']) ?></strong>
                            </td>

                            <td>
                                <a href="mailto:<?= esc($customer['email']) ?>">
                                    <?= esc($customer['email']) ?>
                                </a>
                            </td>

                            <td>
                                <?= esc($customer['phone'] ?: 'Not provided') ?>
                            </td>

                            <td>
                                <a
                                    href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>"
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