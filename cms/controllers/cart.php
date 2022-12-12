<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/cart.php';

class Cart
{
    public function CartAdd($code, $quantity)
    {
        $Cart = new CartModel();
        return $Cart->CartAdd($code, $quantity);
    }

    public function CartRemove($code)
    {
        $Cart = new CartModel();
        return $Cart->CartRemove($code);
    }

    public function CartEmpty()
    {
        $Cart = new CartModel();
        return $Cart->CartEmpty();
    }
}

$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["add"])) {
        if (isset($_POST['productId'], $_POST['quantity'])) {
            $productId = (int)$_POST['productId'];
            $quantity = (int)$_POST['quantity'];
            $cart->CartAdd($productId, $quantity);
            $response = "Product added to cart";
        }
    }   
}