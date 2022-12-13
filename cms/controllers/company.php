<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/companydata.php';

class Company
{
    public function GetCompanyArray()
    {
        $Company = new CompanyModel();
        return $Company->CompanyDataArray();
    }

    public function UpdateCompanyData($data): string
    {
        $Company = new CompanyModel();
        $title = (string) $data['title'];
        $email = (string) $data['email'];
        $phone = (string) $data['phone'];
        $desc = (string) $data['desc'];
        $street = (string) $data['street'];
        $city = (string) $data['street'];
        $postal = (string) $data['postalCode'];
        $image = (string) $data['image'];

       /* $validationError = Validator::CompanyInfoForm($title, $desc, $footerDesc, $address, $phone, $mail, $image);
        if ($validationError) {
            return $validationError;
        }*/

        $response = $Company->UpdateCompanyData($title, $email, $phone, $desc, $street, $city, $postal, $image);

        return ($response) ? 'Success' : 'Error';
    }

    public function GetCompanyAddress($companyId)
    {
        $Company = new CompanyModel();
        return $Company->GetCompanyAddress($companyId);
    }
}

