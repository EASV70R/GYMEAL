<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class CompanyData extends Database
{
    public function CompanyDataArray()
    {
        $this->prepare('SELECT * FROM `company` ORDER BY `id` ASC LIMIT 1');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function UpdateCompanyData($title, $desc, $footerDesc, $address, $phone, $mail, $image): bool
    {
        $this->prepare('UPDATE `company` SET `title` = ?, `desc` = ?, `footerDesc` = ?, `address` = ?, `phone` = ?, `mail` = ?, `image` = ? WHERE `id` = 1');
        if ($this->statement->execute([$title, $desc, $footerDesc, $address, $phone, $mail, $image]))
        {
            return true;
        } else {
            return false;
        }
    }
}