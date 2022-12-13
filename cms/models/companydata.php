<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/companysql.php';

class CompanyModel extends Database
{
    public function CompanyDataArray()
    {
        $this->prepare(COMPANYDATA);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function UpdateCompanyData($title, $email, $phone, $desc, $street, $city, $postalCode, $image): bool
    {
        /*$this->prepare('UPDATE `company` SET `name` = ?, `email` = ?, `phone` = ?, `desc` = ?, `smalldesc` = ?, `image` = ? WHERE `companyId` = 1');
        if ($this->statement->execute([$title, $email, $phone, $desc, $smalldesc, $image]))
        {
            return true;
        } else {
            return false;
        }*/
        try
        {
            $this->connect()->beginTransaction();
            $this->prepare(UPDATECOMPANYDATA);
            $sanitized_title = htmlspecialchars($title);
		    $sanitized_email = htmlspecialchars($email);
            $sanitized_phone = htmlspecialchars($phone);
            $sanitized_adesc = htmlspecialchars($desc);
            $sanitized_street = htmlspecialchars($street);
            $sanitized_city = htmlspecialchars($city);
            $sanitized_aimage = htmlspecialchars($image);
		    $this->statement->bindParam(':title', $sanitized_title, PDO::PARAM_STR);
            $this->statement->bindParam(':email', $sanitized_email, PDO::PARAM_STR);
            $this->statement->bindParam(':phone', $sanitized_phone, PDO::PARAM_STR);
            $this->statement->bindParam(':adesc', $sanitized_adesc, PDO::PARAM_STR);
            $this->statement->bindParam(':street', $sanitized_street, PDO::PARAM_STR);
            $this->statement->bindParam(':city', $sanitized_city, PDO::PARAM_STR);
            $this->statement->bindParam(':postalCode', $postalCode, PDO::PARAM_INT);
		    $this->statement->bindParam(':aimage', $sanitized_aimage, PDO::PARAM_STR);
            $this->statement->execute();
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            var_dump("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }
}