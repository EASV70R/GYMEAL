<?php
require_once './cms/controllers/company.php';
require_once './cms/controllers/cart.php';

Util::Header();
Util::Navbar();
?>

<main class="container mt-5">
    <div class="testcontainer">
        <div class="col-12 mt-3 mb-2">
            <div class="alert alert-primary" role="alert">
                WIP
            </div>
        </div>
        <div class="container padding-bottom-3x mb-1">
            <div class="table-responsive shopping-cart">
                <?php
   //Reset total cost to do recalc
    if(isset($_SESSION["cart_item"]))
    $item_total = 0;
    ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="/cart/empty">Clear
                                    Cart</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($_SESSION["cart_item"])): ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($_SESSION["cart_item"] as $k => $v) : ?>
                        <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="#"><img
                                            src="https://via.placeholder.com/220x180/FF0000/000000" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="#"><?php echo $v["name"]; ?></a></h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg text-medium"><?php echo $v["quantity"]; ?></td>
                            <td class="text-center text-lg text-medium">
                                <?php echo ($v["price"]*$v["quantity"])." DKK"; ?></td>
                            <td class="text-center"><a class="remove-from-cart"
                                    href="cart/?action=remove&code=<?php echo $v["code"]; ?>" data-toggle="tooltip"
                                    title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php $item_total += ($v["price"]*$v["quantity"]);?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>
            <?php if (isset($_SESSION["cart_item"])): ?>
            <td class="text-center text-lg text-medium"><strong>Total: </strong><?php echo $item_total. " DKK"; ?></td>
            <?php endif; ?>
            <div class="shopping-cart-footer">
                <div class="column"><a class="btn btn-outline-secondary" href="/products"><i
                            class="icon-arrow-left"></i>&nbsp;Back
                        to Shopping</a></div>
                <div class="column"><a class="btn btn-success" href="/checkout">Checkout</a></div>
            </div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>