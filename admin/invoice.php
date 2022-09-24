<?php
require_once '../cms/require.php';
require_once '../cms/controllers/company.php';

Util::IsAdmin();

require_once '../cms/controllers/invoices.php';

$invoice = new Invoices;
$invoices = $invoice->GetInvoicesArray();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["cancel"])) {
        $invoiceId = $_GET["invoiceId"];
        $userId = $_GET["userId"];
        $invoice->DeleteInvoice($invoiceId, $userId);
        Util::Redirect('/invoice.php');
    }
}
// invoice.php?cancel=&invoiceId=4&userId=2
Util::Header();
Util::Navbar();
?>

</br>
</br>
<main class="container mt-5">
    <div class="row justify-content-center">
        <aside class="col-lg-3 col-xl-3">
            <nav class="nav flex-lg-column nav-pills mb-4">
                <a class="nav-link" href="<?= (BASE_PATH); ?>admin/index.php">Admin</a>
                <a class="nav-link active" href="<?= (BASE_PATH); ?>admin/invoice.php">Customer Invoices</a>
                <a class="nav-link" href="<?= (BASE_PATH); ?>admin/adminsettings.php">Settings</a>
                <a class="nav-link" href="<?= (BASE_PATH); ?>logout.php">Logout</a>
            </nav>
        </aside>
        <div class="col-lg-9 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Profile</h4>
                    <figcaption class="info">
                        <h6 class="title"><?= Util::Print(Session::Get('username'));?></h6>
                        <p>Email: <?= Util::Print(Session::Get('email'));?>, Phone:
                            <?= Util::Print(Session::Get('phone'));?>
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
                                    <h6 class="mb-0">Invoice ID: <?= Util::Print($row->invoiceId); ?><i class="dot"></i>
                                        <?php if ($row->status == 0) : ?>
                                        <span
                                            class="text-danger"><?= Util::Print($invoice->GetInvoiceStatus($row->invoiceId, $row->userId)->status); ?></span>
                                        <?php else : ?>
                                        <span
                                            class="text-success"><?= Util::Print($invoice->GetInvoiceStatus($row->invoiceId, $row->userId)->status); ?></span>
                                        <?php endif; ?>
                                    </h6>
                                    <span class="text-muted">Date: <?= Util::Print($row->createdAt); ?></span>
                                </div>
                                <div>
                                    <a href="<?= (BASE_PATH); ?>admin/invoice.php?cancel=&invoiceId=<?= Util::Print($row->invoiceId); ?>&userId=<?= Util::Print($row->userId); ?>"
                                        class="btn btn-sm btn-outline-danger">Cancel order</a>
                                    <a href="#" class="btn btn-sm btn-primary">Track order</a>
                                </div>
                            </header>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p class="mb-0 text-muted">Shipping address:</p>
                                    <p class="m-0"><?= Util::Print($row->country); ?><br>
                                        <?= Util::Print($row->city); ?> <?= Util::Print($row->region); ?>,
                                        <?= Util::Print($row->address); ?></p>
                                </div>
                            </div>
                            <hr>
                            <ul class="row">
                                <li class="col-xl-4  col-lg-6">
                                    <figure class="itemside mb-3">
                                        <div class="aside">
                                            <img width="72" height="72" src="" alt="test" class="img-sm rounded border">
                                        </div>
                                        <figcaption class="info">
                                            <p class="title"><?= Util::Print($row->itemName); ?></p>
                                            <strong> $<?= Util::Print($row->price); ?> </strong>
                                        </figcaption>
                                    </figure>
                                </li>
                            </ul>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>