<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="page-heading">
    <div class="container">
        <p class="eyebrow">ACCOUNT DIRECTORY</p>
        <h1>Customer Accounts</h1>
        <p><?= count($customers) ?> customer records were retrieved from the MySQL database.</p>
    </div>
</section>

<section class="container table-section">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Email address</th>
                    <th>Phone number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $index => $customer): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= esc($customer['full_name']) ?></strong></td>
                        <td>
                            <a href="mailto:<?= esc($customer['email']) ?>">
                                <?= esc($customer['email']) ?>
                            </a>
                        </td>
                        <td><?= esc($customer['phone']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>