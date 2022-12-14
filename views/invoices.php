<?php
require_once './cms/controllers/company.php';

Util::IsLoggedIn();

require_once './cms/controllers/invoices.php';

$invoice = new Invoices;
$invoices = $invoice->GetUserInvoices();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["cancel"])) {
        $invoiceId = $_GET["invoiceId"];
        $invoice->DeleteInvoice($invoiceId, Session::Get('uid'));
        Util::Redirect('/invoices.php');
    }
}

Util::Header();
Util::Navbar();

?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="row justify-content-center">
            <aside class="col-lg-3 col-xl-3">
                <nav class="nav flex-lg-column nav-pills mb-4">
                    <a class="nav-link" href="/profile">Account</a>
                    <a class="nav-link" href="/profilesettings">Settings</a>
                    <a class="nav-link active" href="/orders">Orders</a>
                    <a class="nav-link" href="/logout">Logout</a>
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
                                        <span class="text-muted">Total Price: <?= $row->totalprice; ?></span>
                                        </br>
                                        <span class="text-muted">Date: <?= $row->orderDate; ?></span>
                                    </div>
                                    <div>   
                                        <a href="/vieworder/<?= Session::Get("uid"); ?>/<?= $row->orderId; ?>" class="btn btn-sm btn-primary">View order</a>
                                        <a href="#" class="btn btn-sm btn-secondary">Track order</a>
                                    </div>
                                </header>
                                <hr>
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