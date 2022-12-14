<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/productsql.php';

class ProductModel extends Database
{
    public function ProductArray()
    {
        $this->prepare(PRODUCTS);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function LatestProductFirst()
    {
        $this->prepare(LATESTPRODUCT);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function LatestProductOffsetByOne()
    {
        $this->prepare(LATESTPRODUCTBYONE);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function CreateProduct($title, $code, $quantity, $desc, $image, $price, $category): bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare(CREATEPRODUCT);
            $sanitized_title = htmlspecialchars($title);
            $sanitized_code = htmlspecialchars($code);
		    $sanitized_desc = htmlspecialchars($desc);
            $sanitized_aimage = htmlspecialchars($image);
		    $this->statement->bindParam(':title', $sanitized_title, PDO::PARAM_STR);
            $this->statement->bindParam(':code', $sanitized_code, PDO::PARAM_STR);
            $this->statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $this->statement->bindParam(':adesc', $sanitized_desc, PDO::PARAM_STR);
            $this->statement->bindParam(':aimage', $sanitized_aimage, PDO::PARAM_STR);
            $this->statement->bindParam(':price', $price, PDO::PARAM_INT);
            $this->statement->bindParam(':productFilterId', $category, PDO::PARAM_INT);
            $this->statement->execute();
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
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
            $this->prepare(UPDATEPRODUCT);
            $sanitized_title = htmlspecialchars($title);
            $sanitized_code = htmlspecialchars($code);
            $sanitized_desc = htmlspecialchars($desc);
            $sanitized_aimage = htmlspecialchars($image);
            $this->statement->bindParam(':productId', $id, PDO::PARAM_INT);
            $this->statement->bindParam(':title', $sanitized_title, PDO::PARAM_STR);
            $this->statement->bindParam(':code', $sanitized_code, PDO::PARAM_STR);
            $this->statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $this->statement->bindParam(':adesc', $sanitized_desc, PDO::PARAM_STR);
            $this->statement->bindParam(':aimage', $sanitized_aimage, PDO::PARAM_STR);
            $this->statement->bindParam(':price', $price, PDO::PARAM_INT);
            $this->statement->bindParam(':productFilterId', $category, PDO::PARAM_INT);
            $this->statement->execute();
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
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
            $this->prepare(DELETPRODUCT);
            $this->statement->bindParam(':productID', $productID, PDO::PARAM_INT);
            $this->statement->execute();
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function ProductQuantityStatus($productID)
    {
        $this->prepare(PRODUCTSTATUS);
        $this->statement->bindParam(':productID', $productID, PDO::PARAM_INT);
        $this->statement->execute();
        $result = $this->fetch();
        $result->quantity = ((int) $result->quantity === 0) ? 'Out of Stock' : 'Available';
        return $result;
    }

    public function ProductFilter($filterId)
    {
        $this->prepare(INNERJOINPRODUCTFILTER);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function ProductMealFilter()
    {
        $this->prepare(FILTERMEALS);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function ProductDrinkFilter()
    {
        $this->prepare(FILTERDRINKS);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function ProductById($id)
    {
        $this->prepare(PRODUCTBYID);
        $this->statement->bindParam(':productID', $id, PDO::PARAM_INT);
        $this->statement->execute();
        return $this->fetchAll();
    }
}