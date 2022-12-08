<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class ProductModel extends Database
{
    public function ProductArray()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function LatestProductFirst()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 1');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function LatestProductOffsetByOne()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 5 OFFSET 1');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function CreateProduct($title, $code, $quantity, $desc, $image, $price, $category): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `product` (`title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) VALUES (:title, :code, :quantity, :adesc, :aimage, :price, :productFilterId)');
            $sanitized_title = htmlspecialchars($title);
            $sanitized_code = htmlspecialchars($code);
		    $sanitized_desc = htmlspecialchars($desc);
            $sanitized_aimage = htmlspecialchars($image);
		    $this->statement->bindParam(':title', $sanitized_title);
            $this->statement->bindParam(':code', $sanitized_code);
            $this->statement->bindParam(':quantity', $quantity);
            $this->statement->bindParam(':adesc', $sanitized_desc);
            $this->statement->bindParam(':aimage', $sanitized_aimage);
            $this->statement->bindParam(':price', $price);
            $this->statement->bindParam(':productFilterId', $category);
            $this->statement->execute();
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function UpdateProduct($id, $title, $code, $quantity, $desc, $image, $price, $category): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('UPDATE `product` SET `title` = :title, `code` = :code, `quantity` = :quantity, `desc` = :adesc, `image` = :aimage, `price` = :price, `productFilterId` = :productFilterId WHERE `productId` = :productId');
            $sanitized_title = htmlspecialchars($title);
            $sanitized_code = htmlspecialchars($code);
            $sanitized_desc = htmlspecialchars($desc);
            $sanitized_aimage = htmlspecialchars($image);
            $this->statement->bindParam(':productId', $id);
            $this->statement->bindParam(':title', $sanitized_title);
            $this->statement->bindParam(':code', $sanitized_code);
            $this->statement->bindParam(':quantity', $quantity);
            $this->statement->bindParam(':adesc', $sanitized_desc);
            $this->statement->bindParam(':aimage', $sanitized_aimage);
            $this->statement->bindParam(':price', $price);
            $this->statement->bindParam(':productFilterId', $category);
            $this->statement->execute();
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function DeleteProduct($productID)
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('DELETE FROM `product` WHERE `productId` = :productID');
            $this->statement->bindParam(':productID', $productID);
            $this->statement->execute();
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function ProductQuantityStatus($productID)
    {
        $this->prepare('SELECT * FROM `product` WHERE `productId` = :productID');
        $this->statement->bindParam(':productID', $productID);
        $this->statement->execute();
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

    public function ProductById($id)
    {
        $this->prepare('SELECT * FROM `product` WHERE `productId` = :productID');
        $this->statement->bindParam(':productID', $id);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }
}