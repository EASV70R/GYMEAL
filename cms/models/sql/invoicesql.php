<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('INVOICES', 'SELECT * FROM `invoices` ORDER BY `invoiceId` DESC');
define('INVOICEFROMUID', 'SELECT * FROM `invoices` WHERE `userId` = ? ORDER BY `invoiceId` DESC');
define('DELETEINVOICE', 'DELETE FROM `invoices` WHERE `invoiceId` = ? AND `userId` = ?');
define('INVOICESTATUS', 'SELECT * FROM `invoices` WHERE `invoiceId` = ? and `userId` = ?');