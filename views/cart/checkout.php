<?php
require_once './cms/require.php';
require_once './cms/controllers/company.php';

Util::Header();
Util::Navbar();
?>
<section class="checkout">
    <div class="content-wrapper">
        <h1>Your Order Has Been Placed</h1>
        <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
    </div>
</section>

<?php Util::Footer(); ?>