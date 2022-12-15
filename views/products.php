<?php
require_once './cms/controllers/company.php';

require_once './cms/controllers/products.php';
require_once './cms/controllers/cart.php';

$product = new Products;
$products = $product->GetProductArray();
$mealFilter = $product->ProductMealFilter();
$drinkFilter = $product->ProductDrinkFilter();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["product"])) {
        $productId = $_GET["id"];
        $product->ProductId($productId);
    }
}

Util::Header();
Util::Navbar();
?>
<main class="testcontainer">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="col-12 mt-3 mb-2">
                <?php if (isset($response)) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= $response; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s"
                        style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Our Products</h1>
                        <p>Welcome to our meal selection page! Here, you can browse through a variety of nutritious and delicious meals that are designed to complement your favorite protein drink. Whether you're looking for a hearty breakfast, a satisfying lunch, or a flavorful dinner, we have a variety of options to choose from. Simply select the meal that fits your dietary needs and preferences, and add a protein-rich drink on the side
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill"
                                href="#tab-1">Meals</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Drinks </a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-3">Others</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php foreach ($mealFilter as $row) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <form method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="productId" value="<?= $row->productId; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="quantity" value="1">
                                </div>
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-wrapper" src="<?= $row->image; ?>" alt="">
                                        <!-- img-fluid w-100 <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div> -->
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2"
                                            href="<?= (SITE_URL); ?>/productview/<?= $row->productId; ?>"><?= $row->title; ?></a>
                                        <span class="text-primary me-1"><?= $row->price; ?> DKK</span>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="w-50 text-center border-end py-2">
                                            <a class="text-body"
                                                href="<?= (SITE_URL); ?>/productview/<?= $row->productId; ?>"><i
                                                    class="fa fa-eye text-primary me-2"></i>View
                                                detail</a>
                                        </small>
                                        <small class="w-50 text-center py-2">
                                            <div class="form-group">
                                                <div class="text-body">
                                                    <button class="textbutton" name="add" type="add" value="add"><i
                                                            class="fa fa-shopping-bag text-primary me-2"></i>Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php foreach ($drinkFilter as $row) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <form method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="productId" value="<?= $row->productId; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="quantity" value="1">
                                </div>
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-wrapper" src="<?= $row->image; ?>" alt="">
                                        <div
                                            class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            New</div>
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2"
                                            href="<?= (SITE_URL); ?>/productview/<?= $row->productId; ?>"><?= $row->title; ?></a>
                                        <span class="text-primary me-1"><?= $row->price; ?> DKK</span>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="w-50 text-center border-end py-2">
                                            <a class="text-body"
                                                href="<?= (SITE_URL); ?>/productview/<?= $row->productId; ?>"><i
                                                    class="fa fa-eye text-primary me-2"></i>View
                                                detail</a>
                                        </small>
                                        <small class="w-50 text-center py-2">
                                            <div class="form-group">
                                                <div class="text-body">
                                                    <button class="textbutton" name="add" type="add" value="add"><i
                                                            class="fa fa-shopping-bag text-primary me-2"></i>Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-12 text-center">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                    <div
                                        class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                        New</div>
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2" href="">Banana</a>
                                    <span class="text-primary me-1">$19.00</span>
                                    <span class="text-body text-decoration-line-through">$29.00</span>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-50 text-center border-end py-2">
                                        <a class="text-body"
                                            href="<?= (SITE_URL); ?>/productview/<?= $row->productId; ?>"><i
                                                class="fa fa-eye text-primary me-2"></i>View
                                            detail</a>
                                    </small>
                                    <small class="w-50 text-center py-2">
                                        <a class="text-body" href=""><i
                                                class="fa fa-shopping-bag text-primary me-2"></i>Add
                                            to cart</a>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 text-center">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="">Browse More Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php Util::Footer(); ?>