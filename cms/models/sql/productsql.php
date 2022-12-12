<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('PRODUCTS', 'SELECT * FROM `product` ORDER BY `productId` DESC');
define('LATESTPRODUCT', 'SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 1');
define('LATESTPRODUCTBYONE', 'SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 5 OFFSET 1');
define('CREATEPRODUCT', 'INSERT INTO `product` (`title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) VALUES (:title, :code, :quantity, :adesc, :aimage, :price, :productFilterId)');
define('UPDATEPRODUCT', 'UPDATE `product` SET `title` = :title, `code` = :code, `quantity` = :quantity, `desc` = :adesc, `image` = :aimage, `price` = :price, `productFilterId` = :productFilterId WHERE `productId` = :productId');
define('DELETPRODUCT', 'DELETE FROM `product` WHERE `productId` = :productID');
define('PRODUCTSTATUS', 'SELECT * FROM `product` WHERE `productId` = :productID');
define('INNERJOINPRODUCTFILTER', 'SELECT * FROM `product` as pdt INNER JOIN productfilter as pdtF ON(pdt.productFilterId=pdtF.productFilterId) ORDER BY `productId` DESC');
define('FILTERMEALS', 'SELECT * FROM `product` WHERE `productFilterId` = 1 ORDER BY `productId` DESC');
define('FILTERDRINKS', 'SELECT * FROM `product` WHERE `productFilterId` = 2 ORDER BY `productId` DESC');
define('PRODUCTBYID', 'SELECT * FROM `product` WHERE `productId` = :productID');