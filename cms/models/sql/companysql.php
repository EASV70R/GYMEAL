<?php
defined('BASE_PATH') or exit('No direct script access allowed');

define('COMPANYDATA', 'SELECT * FROM `company` AS com INNER JOIN `address` AS addr ON(com.addressId=addr.addressId) INNER JOIN `country` as cntr ON(addr.countryId=cntr.countryId) ORDER BY `companyId` ASC LIMIT 1;');
define('UPDATECOMPANYDATA', 'UPDATE company AS cmpn INNER JOIN address AS addr ON cmpn.addressId=addr.addressId SET cmpn.name = :title, cmpn.email = :email, cmpn.phone = :phone, cmpn.desc = :adesc,
cmpn.image=:aimage, addr.street=:street, addr.city=:city, addr.postalCode=:postalCode WHERE cmpn.addressId=1');