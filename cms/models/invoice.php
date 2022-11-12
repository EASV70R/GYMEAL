<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class InvoiceModel extends Database
{
    public function InvoiceArray()
    {
        $this->prepare('SELECT * FROM `invoices` ORDER BY `invoiceId` DESC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function InvoiceFromCurrentUID()
    {
        $this->prepare('SELECT * FROM `invoices` WHERE `userId` = ? ORDER BY `invoiceId` DESC');
        $this->statement->execute([Session::Get('uid')]);
        return $this->statement->fetchAll();
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $this->prepare('DELETE FROM `invoices` WHERE `invoiceId` = ? AND `userId` = ?');
        $this->statement->execute([$invoiceID, $userID]);
    }

    public function InvoiceStatus($invoiceID, $userID)
    {
        $this->prepare('SELECT * FROM `invoices` WHERE `invoiceId` = ? and `userId` = ?');
        $this->statement->execute([$invoiceID, $userID]);
        $result = $this->statement->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }
}