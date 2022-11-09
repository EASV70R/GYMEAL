<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/companydata.php';

class Company
{
    public function GetCompanyArray()
    {
        $Company = new CompanyData();
        return $Company->CompanyDataArray();
    }

    public function UpdateCompanyData($data): string
    {
        $Company = new CompanyData();
        $title = (string) $data['title'];
        $desc = (string) $data['desc'];
        $smalldesc = (string) $data['smalldesc'];
        $image = (string) $data['image'];

       /* $validationError = Validator::CompanyInfoForm($title, $desc, $footerDesc, $address, $phone, $mail, $image);
        if ($validationError) {
            return $validationError;
        }*/

        $response = $Company->UpdateCompanyData($title, $desc, $smalldesc, $image);
        return ($response) ? 'Success' : 'Error';
    }

    public function GetCompanyAddress($companyId)
    {
        $Company = new CompanyData();
        return $Company->GetCompanyAddress($companyId);
    }
}