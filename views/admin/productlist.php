<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::IsAdmin();

require_once './cms/controllers/products.php';

$product = new products;
var_dump($product->GetProductStatus(1));
$products = $product->GetProductArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["cuItem"])) {
        $error = $product->CreateProduct($_POST);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["delete"])) {
        $productId = $_GET["productId"];
        $product->DeleteProduct($productId);
        Util::Redirect('/productlist');
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
        <div class="col-12 mt-3 mb-2">
            <?php if (isset($error)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= Util::Print($error); ?>
            </div>
            <?php endif; ?>
        </div>
        <aside class="col-lg-3 col-xl-3">
            <nav class="nav flex-lg-column nav-pills mb-4">
                <a class="nav-link" href="<?= (SITE_URL); ?>/admin">Admin</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/editinvoice">Customer Invoices</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/admsettings">Settings</a>
                <a class="nav-link active" href="<?= (SITE_URL); ?>/editproductlist">Products</a>
                <a class="nav-link" href="<?= (SITE_URL); ?>/logout">Logout</a>
            </nav>
        </aside>
        <div class="col-lg-9 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Create / Update Product</h4>
                            <form method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="Item Name"
                                        name="itemName" required>
                                </div>
                                <div class="form-group">
                                    <input type="itemDesc" class="form-control form-control-sm"
                                        placeholder="Item Description" name="itemDesc" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-sm" placeholder="Quantity"
                                        name="itemQuantity" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-sm" placeholder="Price"
                                        name="itemPrice" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-sm" placeholder="Filter"
                                        name="filterId" min="1" max="3" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="Item Image"
                                        name="itemImage" required>
                                </div>
                                <button class="btn btn-outline-primary btn-block" name="cuItem" type="submit"
                                    value="submit">Create / Update
                                </button>
                            </form>
                        </div>
                    </div>
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
                                    <a href="<?= (SITE_URL); ?>/editproductlist/?edit=&id=<?= Util::Print($row->productId); ?>"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?= (SITE_URL); ?>/editproductlist/?delete=&productId=<?= Util::Print($row->productId); ?>"
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