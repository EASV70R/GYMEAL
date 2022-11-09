<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class CompanyData extends Database
{
    public function CompanyDataArray()
    {
        $this->prepare('SELECT * FROM `company` AS com INNER JOIN `address` AS addr ON(com.addressId=addr.addressId) ORDER BY `companyId` ASC LIMIT 1');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function UpdateCompanyData($title, $email, $phone, $desc, $smalldesc, $address, $image): bool
    {
        /*$this->prepare('UPDATE `company` SET `name` = ?, `email` = ?, `phone` = ?, `desc` = ?, `smalldesc` = ?, `image` = ? WHERE `companyId` = 1');
        if ($this->statement->execute([$title, $email, $phone, $desc, $smalldesc, $image]))
        {
            return true;
        } else {
            return false;
        }*/
        $this->prepare('UPDATE `company` SET `name` = :title, `email` = :email, `phone` = :phone, `desc` = :adesc, `smalldesc` = :smalldesc, `image` = :aimage WHERE `companyId` = 1');
        $sanitized_fullName = htmlspecialchars($title);
		$sanitized_email = htmlspecialchars($email);
        $sanitized_phone = htmlspecialchars($phone);
        $sanitized_adesc = htmlspecialchars($desc);
        $sanitized_smalldesc = htmlspecialchars($smalldesc);
        $sanitized_aimage = htmlspecialchars($image);
		$this->statement->bindParam(':title', $sanitized_fullName);
        $this->statement->bindParam(':email', $sanitized_email);
        $this->statement->bindParam(':phone', $sanitized_phone);
        $this->statement->bindParam(':adesc', $sanitized_adesc);
        $this->statement->bindParam(':smalldesc', $sanitized_smalldesc);
		$this->statement->bindParam(':aimage', $sanitized_aimage);
        if ($this->statement->execute())
        {
            return true;
        } else {
            return false;
        }
    }
}