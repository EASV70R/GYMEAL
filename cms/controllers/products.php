<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/product.php';

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

    public function CreateProduct($data): string
    {
        $Product = new ProductData();

        $title = trim($data['itemName']);
        $desc = trim($data['itemDesc']);
        $price = (int)$data['itemPrice'];
        $quantity = (int)$data['itemQuantity'];
        $image = trim($data['itemImage']);
        $productFilterId = (int)$data['filterId'];

        $response = $Product->CreateProduct($title, $quantity, $desc, $image, $price, $productFilterId);

        return ($response) ? 'Product created.' : 'Product creation failed.';
    }

    public function UpdateProduct($data): string
    {
        $Product = new ProductData();

        $title = trim($data['itemName']);
        $desc = trim($data['itemDesc']);
        $price = (int)$data['itemPrice'];
        $quantity = (int)$data['itemQuantity'];
        $image = trim($data['itemImage']);
        $productFilterId = (int)$data['filterId'];
        $id = (int)$_GET["id"];

        $response = $Product->UpdateProduct($id, $title, $quantity, $desc, $image, $price, $productFilterId);

        return ($response) ? 'Product updated.' : 'Product update failed.';
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

    public function GetProductById($id)
    {
        $Product = new ProductData();
        return $Product->ProductById($id);
    }
}