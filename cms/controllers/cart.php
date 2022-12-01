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