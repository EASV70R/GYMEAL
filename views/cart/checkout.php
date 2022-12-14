<?php
require_once './cms/controllers/company.php';
require_once './cms/controllers/invoices.php';

/*if(!Session::Get('login'))
{
    $error = 'You must be logged in to view this page.';
    util::Redirect('/register');
}*/

$invoices = new Invoices();
//$createcustomer = $invoices->CreateCustomerData();
$getprice = 0;
if(empty($getprice))
{
foreach($_SESSION["cart_item"] as $k => $v) {
    $getprice += ($v["price"]*$v["quantity"]);
}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["createorder"])) {

        $_POST["totalPrice"]=$getprice;
        $error = $invoices->CreateCustomerData($_POST);
        
        util::Redirect('/order');
    }
}

Util::Header();
Util::Navbar();
?>
<link href="form-validation.css" rel="stylesheet">

<main class="testcontainer">

    <div class="container">
        <div class="col-12 mt-3 mb-2">
            <?php if (isset($error)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= $error; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php if (Session::Get("login")) : ?>
        <div class="py-5 text-center">
            <h2>Checkout</h2>
        </div>
        <?php
   //Reset total cost to do recalc
    if(isset($_SESSION["cart_item"]))
    $item_total = 0;
    ?>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($_SESSION["cart_item"] as $k => $v) : ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?= $v["name"]; ?></h6>
                            <small class="text-muted"><?= $v["desc"]; ?></small>
                        </div>
                        <span class="text-muted"><?= ($v["price"]*$v["quantity"])." DKK"; ?></span>
                    </li>
                    <?php $item_total += ($v["price"]*$v["quantity"]);?>
                    <?php endforeach; ?>
                    <!--<li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">−$5</span>
                    </li>-->
                    <?php if (isset($_SESSION["cart_item"])): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong><?= $item_total. " DKK"; ?></strong>
                    </li>
                    <?php endif; ?>
                </ul>

                <!--<form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>-->
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form method="POST" class="needs-validation" novalidate>
                    <!--   -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" name="email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="+1234567890">
                            <div class="invalid-feedback">
                                Please enter a valid phone number.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" name="address2" placeholder="Apartment or suite">
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" name="country" required>
                                <option value="">Choose...</option>
                                <option>Denmark</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" name="state" required>
                                <option value="">Choose...</option>
                                <option>Esbjerg</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" name="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-address">
                        <label class="form-check-label" for="same-address">Shipping address is the same as my billing
                            address</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="save-info">
                        <label class="form-check-label" for="save-info">Save this information for next time</label>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked
                                required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">

                    <!-- <a href="/order" class="w-100 btn btn-primary btn-lg">Continue to checkout</a> -->
                    <button class="w-100 btn btn-primary btn-lg" name="createorder" type="submit"
                        value="submit">Continue to
                        checkout
                    </button>
                </form>
            </div>
            <?php else : ?>
            <div class="alert alert-primary" role="alert">
                <?= "You must login to purchase" ?>
            </div>
            <?php endif; ?>
        </div>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets\js\formvalidation.js"></script>
</main>

<?php Util::Footer(); ?>