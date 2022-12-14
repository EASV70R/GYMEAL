<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/invoicesql.php';

class InvoiceModel extends Database
{
    public function InvoiceArray()
    {
        $this->prepare(INVOICES);
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function DoesCustomerExist($uid): bool
    {
        $this->prepare('SELECT * FROM `customer` WHERE `uid` = :uid');
        $this->statement->bindParam(':uid', $uid);
        $this->statement->execute();
        $row = $this->statement->fetch();
        if($row)
        {
            return true;
        } else {
            return false;
        }
    }

    public function GetCustomerIdFromUID($uid)
    {
        $this->prepare('SELECT `customerId` FROM `customer` WHERE `uid` = :uid');
        $this->statement->bindParam(':uid', $uid);
        $this->statement->execute();
        return $this->statement->fetch();
    }

    public function CreateProductPurchases($orderID, $productID, $quantity, $price) : bool
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `productpurchase` (`quantity`, `price`, `orderId`, `productId`) VALUES (?, ?, ?, ?)');
            $this->statement->execute([$quantity, $price, $orderID, $productID]);
            $this->statement->commit();
            return true;
        } catch (Throwable $error) {
            $this->statement->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        }
    }

    public function CreateCustomerData($firstName, $lastName, $phone, $address, $totalprice, $uid/*, $productID, $quantity, $price*/) : bool
    {
        //var_dump($productID);
        try{
            $this->connect()->beginTransaction();
            if($this->DoesCustomerExist($uid))
            {
                $this->prepare('INSERT INTO `order` (`totalprice`, `status`, `orderDate`, `customerId`) VALUES (?, ?, ?, ?)');
                $this->statement->execute([$totalprice, 0, date('Y-m-d H:i:s', time()), $this->GetCustomerIdFromUID($uid)->customerId]);
                //$id = $this->connect()->lastInsertId();
                //$this->prepare('INSERT INTO `purchases` (`quantity`, `price`, `orderId`, `productId`) VALUES (?, ?, ?, ?)');
                //$this->statement->execute([$quantity, $price, $id, $productID]);
                //var_dump($this->DoesCustomerExist($uid));
                //var_dump($this->GetCustomerIdFromUID($uid)->customerId);
            } else {
                $this->prepare('INSERT INTO `customer` (`firstName`, `lastName`, `phone`, `addressId`, `uid`) VALUES (:firstName, :lastName, :phone, :addressId, :uid)');
                $sanatized_firstname = htmlspecialchars($firstName);
                $sanatized_lastname = htmlspecialchars($lastName);
                $sanatized_phone = htmlspecialchars($phone);
                $this->statement->bindParam(':firstName', $sanatized_firstname, PDO::PARAM_STR);
                $this->statement->bindParam(':lastName', $sanatized_lastname, PDO::PARAM_STR);
                $this->statement->bindParam(':phone', $sanatized_phone, PDO::PARAM_STR);
                $this->statement->bindParam(':addressId', $address, PDO::PARAM_INT);
                $this->statement->bindParam(':uid', $uid, PDO::PARAM_INT);
                $this->statement->execute();
                $id = $this->connect()->lastInsertId();
                $this->prepare('INSERT INTO `order` (`totalprice`, `status`, `orderDate`, `customerId`) VALUES (?, ?, ?, ?)');
                $this->statement->execute([$totalprice, 0, date('Y-m-d H:i:s', time()), $id]);
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollBack();
            print_r("Error: " . $e->getMessage());
            return false;
        }
    }
    public function CreateInvoice($orderCode, $totalprice, $customerId)
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `order` (`orderCode`, `totalprice`, `status`, `customerId`, `customerId`) VALUES (?, ?, ?, ?, ?)');
            $this->statement->execute([$orderCode, $totalprice, 0, now(), $customerId]);
            //$this->prepare('INSERT INTO `purchases` (`orderId`, `productId`, `price`) VALUES (?, ?, ?)');
            //$this->statement->execute([Session::Get('orderId'), Session::Get('productId'), Session::Get('price')]);
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }

    public function InvoiceFromCurrentUID()
    {
        $this->prepare(INVOICEFROMUID2);
        $this->statement->execute([Session::Get('uid')]);
		/*while($row=$this->statement->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}		
        return $results;*/
        return $this->fetchAll();
    }

    public function InvoiceFromOrderId($orderId)
    {
        $this->prepare(INVOICEFROMORDERID);
        $this->statement->execute([$orderId, Session::Get('uid')]);
        return $this->fetchAll();
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $this->prepare(DELETEINVOICE);
        $this->statement->execute([$invoiceID, $userID]);
        $this->close();
    }

    public function InvoiceStatus($invoiceID, $userID)
    {
        $this->prepare(INVOICESTATUS);
        $this->statement->execute([$invoiceID, $userID]);
        $result = $this->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }

    public function UpdateInvoiceStatus($status, $invoiceID)
    {
        $this->prepare(UPDATEINVOICE);
        $this->statement->execute([$status, $invoiceID]);
        $this->close();
    }

    public function CustomerInfo()
    {
        $this->prepare(CUSTOMERINFO);
        $this->statement->execute([Session::Get('uid')]);
        return $this->fetchAll();
    }

    public function ProductData($orderId)
    {
        $this->prepare(PRODUCTDATA);
        $this->statement->execute([$orderId]);
        return $this->fetchAll();
    }
}