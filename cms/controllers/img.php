<?php

require_once __DIR__.'/../models/imgresize.php';

class Image
{
    /*public function UploadImg($data) : void
    {
        $Image = new ImgResizeModel();

        $imagefile = (string) $data['imagefile'];
        $width = (int) $data['width'];
        $height = (int) $data['height'];

        $Image->load($imagefile);
        $Image->resize($width, $height);
        $Image->save("test.jpg");
        $Image->UploadImg("test.jpg");
    }*/

    public function UploadImg($imagefile, $width, $height, $newfile) : void
    {
        $Image = new ImgResizeModel();

        $Image->load($imagefile);
        $Image->resize($width, $height);
        $Image->save($newfile);
        //$Image->UploadImg($newfile);
    }
}

/*$imgresize = new Image();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["uploadproductimg"]))
    {
        if($_FILES['file']['size'] == 0)
        {
            var_dump($_POST);
            $error = $companyData->UpdateCompanyData($_POST);
        }
        if ((($_FILES['file']['type']=="image/gif") ||
        ($_FILES['file']['type']=="image/jpeg") ||
        ($_FILES['file']['type']=="image/png") ||
        ($_FILES['file']['type']=="image/pjpeg"))&&
        ($_FILES['file']['size']<10000000))
        {
        if($_FILES['file']['error']>0)
        {
            $error = "Return Code: " . $_FILES['file']['error'];
        }else{
            if (file_exists("assets/img/".$_FILES['file']['name'])){
                $error = $_FILES['file']['name']. " already exists. ";
            }else{
                $imgresize->UploadImg($_FILES['file']['tmp_name'], 500, 650, "assets/img/product_".$_FILES['file']['name']);
                //$_POST['image'] = "assets/img/product_".$_FILES['file']['name'];
            }
        }
        }else{ 
            $error = "Invalid file";
        }   
    }
}*/
