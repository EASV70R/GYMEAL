<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/invoice.php';

/*if (!Session::Get('login')) {
    http_response_code(403);
    exit();
}*/

class Invoices
{
    public function GetInvoicesArray()
    {
        $Invoice = new InvoiceModel();
        return $Invoice->InvoiceArray();
    }

    public function GetUserInvoices()
    {
        $Invoice = new InvoiceModel();
        return $Invoice->InvoiceFromCurrentUID();
    }

    public function CreateCustomerData($data) : string
    {
        $Invoice = new InvoiceModel();
        $firstName = (string)$data['firstName'];
        $lastName = (string)$data['lastName'];
        $phone = (string)$data['phone'];
        $totalprice = (int)$data['totalPrice'];
       /* $productId = (int)$data['productId'];
        $quantity = (int)$data['quantity'];
        $price = (int)$data['price'];*/
        $uid = Session::Get('uid');

        //var_dump($data);
        $response = $Invoice->CreateCustomerData($firstName, $lastName, $phone, 1, $totalprice, $uid,/* 5, $quantity, $price*/);
        
        return ($response) ? 'Customer Created.' : 'Customer Info failed.';
    }

    public function GetInvoiceFromOrderId($orderId)
    {
        $Invoice = new InvoiceModel();
        return $Invoice->InvoiceFromOrderId($orderId);
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $Invoice = new InvoiceModel();
        return $Invoice->DeleteInvoice($invoiceID, $userID);
    }

    public function GetInvoiceStatus($invoiceID, $userID)
    {
        $Invoice = new InvoiceModel();
        return $Invoice->InvoiceStatus($invoiceID, $userID);
    }

    public function UpdateInvoiceStatus($data)
    {
        $Invoice = new InvoiceModel();
        $status = (int)$data['mStatus'];
        $invoiceID = (int)$data['mOrderId'];

        return $Invoice->UpdateInvoiceStatus($status, $invoiceID);
    }

    public function GetCustomerInfo()
    {
        $Invoice = new InvoiceModel();
        return $Invoice->CustomerInfo();
    }

    public function GetProductData($orderId)
    {
        $Invoice = new InvoiceModel();
        return $Invoice->ProductData($orderId);
    }
}