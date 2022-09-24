<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class Invoice extends Database
{
    public function InvoiceFromCurrentUID()
    {
        $this->prepare('SELECT * FROM `invoices` WHERE `userId` = ? ORDER BY `invoiceId` DESC');
        $this->statement->execute([Session::Get('uid')]);
        return $this->statement->fetchAll();
    }

    public function DeleteInvoice($invoiceID)
    {
        $this->prepare('DELETE FROM `invoices` WHERE `invoiceId` = ? AND `userId` = ?');
        $this->statement->execute([$invoiceID, Session::Get('uid')]);
    }

    public function InvoiceStatus($invoiceID)
    {
        $this->prepare('SELECT * FROM `invoices` WHERE `invoiceId` = ? and `userId` = ?');
        $this->statement->execute([$invoiceID, Session::Get('uid')]);
        $result = $this->statement->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }
}