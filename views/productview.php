<?php
require_once './cms/controllers/company.php';

require_once './cms/controllers/products.php';
require_once './cms/controllers/cart.php';

$product = new Products;

Util::Header();
Util::Navbar();
?>

<main class="testcontainer">
    <div class="container">
        <div class="col-12 mt-3 mb-2">
            <?php if (isset($response)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= $response; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="heading-section">
            <h2>Product Details</h2>
        </div>
        <?php foreach ($product->GetProductById($id) as $row) : ?>
        <div class="row">
            <div class="col-md-6">
                <div class="item">
                    <img src="/<?= $row->image; ?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-dtl">
                    <div class="product-info">
                        <div class="product-name"><?= $row->title; ?></div>
                        <div class="reviews-counter">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" checked />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" checked />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" checked />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                            <span>3 Reviews</span>
                        </div>
                        <div class="product-price-discount"><span><?= $row->price; ?> DKK</span>
                            <!--<span class="line-through"></span>-->
                        </div>
                    </div>
                    <p><?= $row->desc; ?></p>

                    <div class="product-count">
                        <label for="size">Quantity</label>
                        <form method="POST">
                            <div class="form-group">
                                <input type="hidden" name="productId" value="<?= $row->productId; ?>">
                            </div>
                            <div class="form-group">
                                <div class="display-flex">
                                    <div class="qtyminus">-</div>
                                    <input type="text" name="quantity" value="<?= $row->quantity; ?>" class="qty">
                                    <div class="qtyplus">+</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="round-black-btn" href="/cart" name="add" type="add" value="add">Add To
                                    Cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                        aria-controls="description" aria-selected="true">Description</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <?= $row->desc; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php Util::Footer(); ?>