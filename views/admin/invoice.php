<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::IsAdmin();

require_once './cms/controllers/invoices.php';

$invoice = new Invoices;
$invoices = $invoice->GetInvoicesArray();

// invoice.php?cancel=&invoiceId=4&userId=2
Util::Header();
Util::Navbar();
?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="row justify-content-center">
            <aside class="col-lg-3 col-xl-3">
                <nav class="nav flex-lg-column nav-pills mb-4">
                    <a class="nav-link" href="<?= (SITE_URL); ?>/admin">Admin</a>
                    <a class="nav-link active" href="<?= (SITE_URL); ?>/editinvoice">Customer Invoices</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/admsettings">Settings</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/editproductlist">Products</a>
                    <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
                </nav>
            </aside>
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Profile</h4>
                        <figcaption class="info">
                            <h6 class="title"><?= Session::Get('username');?></h6>
                            <p>Email: <?= Session::Get('email');?>, Phone:
                                <?= Session::Get('phone');?>
                                <a href="#" class="px-2"><i class="fa fa-pen"></i></a>
                            </p>
                        </figcaption>
                        <hr>
                        <h4 class="card-title text-center">Invoices</h4>
                        <?php foreach ($invoices as $row) : ?>
                        <article class="card border-primary mb-4">
                            <div class="card-body">
                                <header class="d-lg-flex">
                                    <div class="flex-grow-1">

                                        <h6 class="mb-0">Invoice ID: <?= $row->orderId; ?><i class="dot"></i>
                                            <?php if ($row->status == 0) : ?>
                                            <span
                                                class="text-danger"><?= $invoice->GetInvoiceStatus($row->orderId, $row->uid)->status; ?></span>
                                            <?php else : ?>
                                            <span
                                                class="text-success"><?= $invoice->GetInvoiceStatus($row->orderId, $row->uid)->status; ?></span>
                                            <?php endif; ?>
                                        </h6>
                                        <span>Name: <?= $row->firstName; ?> <?= $row->lastName; ?></span>
                                        </br>
                                        <span class="text-muted">Date: <?= $row->orderDate; ?></span>
                                        </br>
                                        <span>Total Price: <?= $row->totalprice; ?></span>
                                    </div>
                                    <div>
                                        <a href="/editinvoice/delete/<?= $row->orderId; ?>/<?= $row->uid; ?>"
                                            class="btn btn-sm btn-outline-danger">Cancel order</a>
                                        <a href="/editorder/<?= $row->uid; ?>/<?= $row->orderId; ?>"
                                            class="btn btn-sm btn-primary">Edit Order</a>
                                    </div>
                                </header>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>