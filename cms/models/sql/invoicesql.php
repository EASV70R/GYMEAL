<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('INVOICES', 'SELECT * FROM `order` AS ord INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) ORDER BY ord.orderId DESC');
define('INVOICEFROMUID', 'SELECT ord.orderId, ord.orderCode, ord.totalprice, ord.status, ord.orderDate, cstm.firstName, cstm.lastName, addr.street, addr.postalCode, addr.city, prc.price FROM `order` AS ord INNER JOIN `purchases` as prc ON(ord.orderId=prc.orderId) INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) INNER JOIN address AS addr ON(cstm.addressId=addr.addressId) WHERE uid=?');
define('DELETEINVOICE', 'DELETE FROM `order` WHERE `orderId` = ? AND `customerId` = ?');
define('INVOICESTATUS', 'SELECT status FROM `order` as ord INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) INNER JOIN user AS usr ON(cstm.uid=usr.uid) WHERE ord.orderId = ? AND usr.uid=?');
define('INVOICEFROMUID2', 'SELECT ord.orderId, ord.totalprice, ord.status, ord.orderDate, cstm.uid FROM `order` AS ord INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) WHERE cstm.uid=?');
define('CUSTOMERINFO', 'SELECT cstm.customerId, cstm.firstName, cstm.lastName, cstm.phone, addr.street, addr.postalCode, addr.city FROM customer AS cstm INNER JOIN address AS addr ON(cstm.addressId=addr.addressId) WHERE cstm.uid=?');
define('INVOICEFROMORDERID', 'SELECT ord.orderId, ord.totalprice, ord.status, ord.orderDate FROM `order` AS ord INNER JOIN customer AS cstm ON(ord.customerId=cstm.customerId) WHERE ord.orderId=? and cstm.uid=?');
define('PRODUCTDATA', 'SELECT prc.productId, prc.quantity, pdt.title, pdt.image, pdt.price FROM `purchases` AS prc INNER JOIN product as pdt ON(prc.productId=pdt.productId) WHERE orderId=?');
define('UPDATEINVOICE', 'UPDATE `order` SET `status` = ? WHERE `orderId` = ?');