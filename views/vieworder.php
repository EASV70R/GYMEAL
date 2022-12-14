<?php
require_once './cms/controllers/company.php';

Util::IsOrderFromUser($uid);

require_once './cms/controllers/invoices.php';

$invoice = new Invoices;
$invoices = $invoice->GetInvoiceFromOrderId($id);
$customer = $invoice->GetCustomerInfo();
$product = $invoice->GetProductData($id);

Util::Header();
Util::Navbar();

 
?>
<? if($uid != Session::Get('uid')) { 
 } ?>
<main class="container mt-5">
    <div class="testcontainer">
        <div class="container mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="invoice p-5">
                            <h5>Your order</h5>
                            <?php foreach ($customer as $row) : ?>
                            <span class="font-weight-bold d-block mt-4">Hello, <?= $row->firstName; ?>
                                <?= $row->lastName; ?></span>
                            <span>You order has been confirmed and will be shipped in next two days!</span>
                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php foreach ($invoices as $invoiceRow) : ?>
                                        <tr>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Order Date</span>
                                                    <span><?= $invoiceRow->orderDate; ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Order No</span>
                                                    <span><?= $invoiceRow->orderId; ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Payment</span>
                                                    <span><img
                                                            src="https://img.icons8.com/color/48/000000/mastercard.png"
                                                            width="20" /></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="py-2">
                                                    <span class="d-block text-muted">Shiping Address</span>
                                                    <span><?= $row->street; ?> - <?= $row->postalCode; ?> -
                                                        <?= $row->city; ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endforeach; ?>
                            <div class="product border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <?php foreach ($product as $productRow) : ?>
                                        <tr>
                                            <td width="20%">
                                                <img src="<?= $productRow->image; ?>" width="90">
                                            </td>
                                            <td width="60%">
                                                <span class="font-weight-bold"><?= $productRow->title; ?></span>
                                                <div class="product-qty">
                                                    <span class="d-block">Quantity: <?= $productRow->quantity; ?></span>
                                                </div>
                                            </td>
                                            <td width="20%">
                                                <div class="text-right">
                                                    <span class="font-weight-bold"><?= $productRow->price; ?> DKK</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                            <?php foreach ($invoices as $invoiceRow) : ?>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Subtotal</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span><?= $invoiceRow->totalprice ?> DKK</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Shipping Fee</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>$22</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">
                                                        <span class="text-muted">Tax Fee</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>$7.65</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-left">

                                                        <span class="text-muted">Discount</span>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span class="text-success">$168.50</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="border-top border-bottom">
                                                <td>
                                                    <div class="text-left">
                                                        <span class="font-weight-bold">Subtotal</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span class="font-weight-bold"><?= $invoiceRow->totalprice ?>
                                                            DKK</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                            <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                            <span>Gymeal Team</span>
                        </div>
                        <div class="d-flex justify-content-between footer p-3">
                            <span>Need Help? <a href="#">Contact us</a></span>
                            <span>© 2022 Gymeal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>