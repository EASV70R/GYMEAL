<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('getproducts', 'SELECT * FROM `product` ORDER BY `productId` DESC');
define('getlatestproduct', 'SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 1');
define('getlatestproductbyone', 'SELECT * FROM `product` ORDER BY `productId` DESC LIMIT 5 OFFSET 1');
define('createproduct', 'INSERT INTO `product` (`title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) VALUES (:title, :code, :quantity, :adesc, :aimage, :price, :productFilterId)');
define('updateproduct', 'UPDATE `product` SET `title` = :title, `code` = :code, `quantity` = :quantity, `desc` = :adesc, `image` = :aimage, `price` = :price, `productFilterId` = :productFilterId WHERE `productId` = :productId');
define('deleteproduct', 'DELETE FROM `product` WHERE `productId` = :productID');
define('getproductstatus', 'SELECT * FROM `product` WHERE `productId` = :productID');
define('innerjoinproductfilter', 'SELECT * FROM `product` as pdt INNER JOIN productfilter as pdtF ON(pdt.productFilterId=pdtF.productFilterId) ORDER BY `productId` DESC');
define('filterbymeals', 'SELECT * FROM `product` WHERE `productFilterId` = 1 ORDER BY `productId` DESC');
define('filterbydrinks', 'SELECT * FROM `product` WHERE `productFilterId` = 2 ORDER BY `productId` DESC');
define('getproductbyid', 'SELECT * FROM `product` WHERE `productId` = :productID');