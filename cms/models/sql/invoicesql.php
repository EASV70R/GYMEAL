<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('INVOICES', 'SELECT * FROM `order` ORDER BY `orderId` DESC');
define('INVOICEFROMUID', 'SELECT ord.orderId, ord.totalprice, ord.status, ord.orderDate, cstm.firstName, cstm.lastName, addr.street, addr.postalCode, addr.city, prc.price FROM `order` AS ord INNER JOIN `purchases` as prc ON(ord.orderId=prc.orderId) INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) INNER JOIN address AS addr ON(cstm.addressId=addr.addressId) WHERE uid=?');
define('DELETEINVOICE', 'DELETE FROM `order` WHERE `orderId` = ? AND `customerId` = ?');
define('INVOICESTATUS', 'SELECT status FROM `order` as ord INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) INNER JOIN user AS usr ON(cstm.uid=usr.uid) WHERE ord.orderId = ? AND usr.uid=?');