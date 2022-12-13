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
                        <?php /*foreach ($invoices as $row) :*/foreach ($invoices as $k => $v) : ?>
                            <?php var_dump($k); ?>
                        <?php var_dump($v); ?>
                        
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>