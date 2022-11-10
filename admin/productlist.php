<?php
require_once '../cms/require.php';
require_once '../cms/controllers/company.php';

Util::IsAdmin();

require_once '../cms/controllers/products.php';

$product = new products;
var_dump($product->GetProductStatus(1));
$products = $product->GetProductArray();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["cancel"])) {
        $invoiceId = $_GET["invoiceId"];
        $userId = $_GET["userId"];
        $invoice->DeleteInvoice($invoiceId, $userId);
        Util::Redirect('/invoice');
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
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin">Admin</a>
                <a class="nav-link active" href="<?= (SITE_URL); ?>/admin/invoice">Customer Invoices</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin/settings">Settings</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
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
                    <h4 class="card-title text-center">Products</h4>
                    <?php foreach ($products as $row) : ?>
                    <article class="card border-primary mb-4">
                        <div class="card-body">
                            <header class="d-lg-flex">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Product ID: <?= Util::Print($row->productId); ?><i class="dot"></i>
                                    <?php if ($row->quantity == 0) : ?>
                                        <span
                                            class="text-danger"><?= Util::Print($product->GetProductStatus($row->productId)->quantity); ?></span>
                                        <?php else : ?>
                                        <span
                                            class="text-success"><?= Util::Print($product->GetProductStatus($row->productId)->quantity); ?></span>
                                        <?php endif; ?>
                                    </h6>
                                    
                                </div>
                                <div>
                                    <a href="<?= (SITE_URL); ?>"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?= (SITE_URL); ?>"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </header>
                            <hr>
                            <ul class="row">
                                <li class="col-xl-4  col-lg-6">
                                    <figure class="itemside mb-3">
                                        <div class="aside">
                                            <img width="72" height="72" src="" alt="test" class="img-sm rounded border">
                                        </div>
                                        <figcaption class="info">
                                            <p class="title"><?= Util::Print($row->title); ?></p>
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