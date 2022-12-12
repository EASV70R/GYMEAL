<?php
require_once './cms/controllers/cart.php';
$cart = new Cart;
$cart->CartRemove($id);
header('Location: /cart');
?>