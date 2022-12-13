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

    public function UpdateCompanyData($title, $email, $phone, $desc, $street, $image): bool
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
            $sanitized_aimage = htmlspecialchars($image);
		    $this->statement->bindParam(':title', $sanitized_title);
            $this->statement->bindParam(':email', $sanitized_email);
            $this->statement->bindParam(':phone', $sanitized_phone);
            $this->statement->bindParam(':adesc', $sanitized_adesc);
            $this->statement->bindParam(':street', $sanitized_street);
		    $this->statement->bindParam(':aimage', $sanitized_aimage);
            $this->statement->execute();
            $this->connect()->commit();
        } catch (Throwable $error) {
            $this->connect()->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }
}