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

    public function CreateCustomerData($firstName, $lastName, $phone, $address, $uid) : bool
    {
        try{
            $this->connect()->beginTransaction();
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