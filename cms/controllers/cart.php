<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/cart.php';

class Cart
{
    public function GetCartArray()
    {
        $Cart = new CartModel();
        return $Cart->CartArray();
    }

    public function ExistingCart($existingItems)
    {
        $Cart = new CartModel();
        return $Cart->ExistingCart($existingItems);
    }

    public function CartAdd($code, $quantity)
    {
        $Cart = new CartModel();
        return $Cart->CartAdd($code, $quantity);
    }
}