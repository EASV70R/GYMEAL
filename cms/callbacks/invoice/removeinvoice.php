<?php
if (!Session::Get('admin')) {
    http_response_code(403);
    exit();
}

require_once './cms/controllers/invoices.php';
$Invoice = new invoices;
$Invoice->DeleteInvoice($id, $uid);
header('Location: /editinvoice');
?>