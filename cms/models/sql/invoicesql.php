<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('getinvoices', 'SELECT * FROM `invoices` ORDER BY `invoiceId` DESC');
define('getinvoicefromuid', 'SELECT * FROM `invoices` WHERE `userId` = ? ORDER BY `invoiceId` DESC');
define('deleteinvoice', 'DELETE FROM `invoices` WHERE `invoiceId` = ? AND `userId` = ?');
define('getinvoicestatus', 'SELECT * FROM `invoices` WHERE `invoiceId` = ? and `userId` = ?');