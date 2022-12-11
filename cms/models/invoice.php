<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/invoicesql.php';

class InvoiceModel extends Database
{
    public function InvoiceArray()
    {
        $this->prepare(getinvoices);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function InvoiceFromCurrentUID()
    {
        $this->prepare(getinvoicefromuid);
        $this->statement->execute([Session::Get('uid')]);
        return $this->statement->fetchAll();
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $this->prepare(deleteinvoice);
        $this->statement->execute([$invoiceID, $userID]);
    }

    public function InvoiceStatus($invoiceID, $userID)
    {
        $this->prepare(getinvoicestatus);
        $this->statement->execute([$invoiceID, $userID]);
        $result = $this->statement->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }
}