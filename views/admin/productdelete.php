<?php
require_once './cms/require.php';

Util::IsAdmin();

require_once './cms/controllers/products.php';
$product = new products;

$product->DeleteProduct($id);
Util::Redirect('/editproductlist');

?>
