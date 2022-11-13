<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::Header();
Util::Navbar();

?>

</br>
</br>
<main class="container mt-5">
    <div class="col-12 mt-3 mb-2">
        <div class="alert alert-primary" role="alert">
            WIP
        </div>
    </div>
    <div class="container padding-bottom-3x mb-1">
        <div class="table-responsive shopping-cart">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-item">
                                <a class="product-thumb" href="#"><img
                                        src="https://via.placeholder.com/220x180/FF0000/000000" alt="Product"></a>
                                <div class="product-info">
                                    <h4 class="product-title"><a href="#">test</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="count-input">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">$43.90</td>
                        <td class="text-center text-lg text-medium">$18.00</td>
                        <td class="text-center"><a class="remove-from-cart" href="#" data-toggle="tooltip" title=""
                                data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="shopping-cart-footer">
            <div class="column"><a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i>&nbsp;Back
                    to Shopping</a></div>
            <div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success"
                    data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart"
                    data-toast-message="is updated successfully!">Update Cart</a><a class="btn btn-success"
                    href="#">Checkout</a></div>
        </div>
    </div>
</main>

<?php Util::Footer(); ?>