<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('getcompanydata', 'SELECT * FROM `company` AS com INNER JOIN `address` AS addr ON(com.addressId=addr.addressId) ORDER BY `companyId` ASC LIMIT 1');
define('updatecompanydata', 'UPDATE `company` SET `name` = :title, `email` = :email, `phone` = :phone, `desc` = :adesc, `smalldesc` = :smalldesc, `image` = :aimage WHERE `companyId` = 1');
define('deleteinvoice', 'DELETE FROM `invoices` WHERE `invoiceId` = ? AND `userId` = ?');
define('getinvoicestatus', 'SELECT * FROM `invoices` WHERE `invoiceId` = ? and `userId` = ?');