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
        return $this->statement->fetchAll();
    }

    public function CreateInvoice( $totalprice, $status, $orderDate, $customerId)
    {
        try{
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `order` (`totalprice`, `status`, `orderDate`, `customerId`) VALUES (?, ?, ?, ?)');
            $this->statement->execute([$totalprice, $status, $orderDate, $customerId]);
            $this->prepare('INSERT INTO `purchases` (`orderId`, `productId`, `price`) VALUES (?, ?, ?)');
            $this->statement->execute([Session::Get('orderId'), Session::Get('productId'), Session::Get('price')]);
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
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
        return $this->statement->fetchAll();
    }

    public function InvoiceFromOrderId($orderId)
    {
        $this->prepare(INVOICEFROMORDERID);
        $this->statement->execute([$orderId, Session::Get('uid')]);
        return $this->statement->fetchAll();
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $this->prepare(DELETEINVOICE);
        $this->statement->execute([$invoiceID, $userID]);
    }

    public function InvoiceStatus($invoiceID, $userID)
    {
        $this->prepare(INVOICESTATUS);
        $this->statement->execute([$invoiceID, $userID]);
        $result = $this->statement->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }

    public function CustomerInfo()
    {
        $this->prepare(CUSTOMERINFO);
        $this->statement->execute([Session::Get('uid')]);
        return $this->statement->fetchAll();
    }

    public function ProductData($orderId)
    {
        $this->prepare(PRODUCTDATA);
        $this->statement->execute([$orderId]);
        return $this->statement->fetchAll();
    }
}