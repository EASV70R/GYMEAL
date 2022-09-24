<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/invoice.php';

if (!Session::Get('login')) {
    http_response_code(403);
    exit();
}

class Invoices
{
    public function GetInvoicesArray()
    {
        $Invoice = new Invoice();
        return $Invoice->InvoiceArray();
    }

    public function GetUserInvoices()
    {
        $Invoice = new Invoice();
        return $Invoice->InvoiceFromCurrentUID();
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $Invoice = new Invoice();
        return $Invoice->DeleteInvoice($invoiceID, $userID);
    }

    public function GetInvoiceStatus($invoiceID, $userID)
    {
        $Invoice = new Invoice();
        return $Invoice->InvoiceStatus($invoiceID, $userID);
    }
}