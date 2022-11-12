<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/product.php';

class Products
{
    public function GetProductArray()
    {
        $Product = new ProductModel();
        return $Product->ProductArray();
    }

    public function GetLatestProductFirst()
    {
        $Product = new ProductModel();
        return $Product->LatestProductFirst();
    }
    
    public function GetLatestProductOffsetByOne()
    {
        $Product = new ProductModel();
        return $Product->LatestProductOffsetByOne();
    }

    public function CreateProduct($data): string
    {
        $Product = new ProductModel();

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
        $Product = new ProductModel();

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
        $Product = new ProductModel();
        return $Product->DeleteProduct($productId);
    }

    public function GetProductStatus($productId)
    {
        $Product = new ProductModel();
        return $Product->ProductQuantityStatus($productId);
    }

    public function ProductFilter($filterId)
    {
        $Product = new ProductModel();
        return $Product->ProductFilter($filterId);
    }

    public function ProductMealFilter()
    {
        $Product = new ProductModel();
        return $Product->ProductMealFilter();
    }

    public function ProductDrinkFilter()
    {
        $Product = new ProductModel();
        return $Product->ProductDrinkFilter();
    }

    public function GetProductById($id)
    {
        $Product = new ProductModel();
        return $Product->ProductById($id);
    }
}