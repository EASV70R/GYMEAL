<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class ProductData extends Database
{
    public function ProductArray()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function DeleteProduct($productID)
    {
        $this->prepare('DELETE FROM `product` WHERE `productId` = ?');
        $this->statement->execute([$productID]);
    }

    public function ProductQuantityStatus($productID)
    {
        $this->prepare('SELECT * FROM `product` WHERE `productId` = ?');
        $this->statement->execute([$productID]);
        $result = $this->statement->fetch();
        $result->quantity = ((int) $result->quantity === 0) ? 'Out of Stock' : 'Available';
        return $result;
    }

    public function ProductFilter($filterId)
    {
        $this->prepare('SELECT * FROM `product` as pdt INNER JOIN productfilter as pdtF ON(pdt.productFilterId=pdtF.productFilterId) ORDER BY `productId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function ProductMealFilter()
    {
        $this->prepare('SELECT * FROM `product` WHERE `productFilterId` = 1 ORDER BY `productId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function ProductDrinkFilter()
    {
        $this->prepare('SELECT * FROM `product` WHERE `productFilterId` = 2 ORDER BY `productId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }
}