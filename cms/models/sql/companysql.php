<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('COMPANYDATA', 'SELECT * FROM `company` AS com INNER JOIN `address` AS addr ON(com.addressId=addr.addressId) INNER JOIN `country` as cntr ON(addr.countryId=cntr.countryId) ORDER BY `companyId` ASC LIMIT 1;');
define('UPDATECOMPANYDATA', 'UPDATE `company` SET `name` = :title, `email` = :email, `phone` = :phone, `desc` = :adesc, `smalldesc` = :smalldesc, `image` = :aimage WHERE `companyId` = 1');