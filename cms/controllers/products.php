<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/productdata.php';

if (!Session::Get('login')) {
    http_response_code(403);
    exit();
}

class Products
{
    public function GetProductArray()
    {
        $Product = new ProductData();
        return $Product->ProductArray();
    }

    public function DeleteProduct($productId)
    {
        $Product = new ProductData();
        return $Product->DeleteProduct($productId);
    }

    public function GetProductStatus($productId)
    {
        $Product = new ProductData();
        return $Product->ProductQuantityStatus($productId);
    }

    public function ProductFilter($filterId)
    {
        $Product = new ProductData();
        return $Product->ProductFilter($filterId);
    }

    public function ProductMealFilter()
    {
        $Product = new ProductData();
        return $Product->ProductMealFilter();
    }

    public function ProductDrinkFilter()
    {
        $Product = new ProductData();
        return $Product->ProductDrinkFilter();
    }
}