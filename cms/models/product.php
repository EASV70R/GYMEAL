<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/productsql.php';

class ProductModel extends Database
{
    public function ProductArray()
    {
        $this->prepare(getproducts);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function LatestProductFirst()
    {
        $this->prepare(getlatestproduct);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function LatestProductOffsetByOne()
    {
        $this->prepare(getlatestproductbyone);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function CreateProduct($title, $code, $quantity, $desc, $image, $price, $category): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare(createproduct);
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
            $this->prepare(updateproduct);
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
            $this->prepare(deleteproduct);
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
        $this->prepare(getproductstatus);
        $this->statement->bindParam(':productID', $productID);
        $this->statement->execute();
        $result = $this->statement->fetch();
        $result->quantity = ((int) $result->quantity === 0) ? 'Out of Stock' : 'Available';
        return $result;
    }

    public function ProductFilter($filterId)
    {
        $this->prepare(innerjoinproductfilter);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function ProductMealFilter()
    {
        $this->prepare(filterbymeals);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function ProductDrinkFilter()
    {
        $this->prepare(filterbydrinks);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function ProductById($id)
    {
        $this->prepare(getproductbyid);
        $this->statement->bindParam(':productID', $id);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }
}