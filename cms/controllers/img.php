<?php

require_once __DIR__.'/../models/imgresize.php';

class Image
{
    public function UploadImg($data) : void
    {
        $Image = new ImgResizeModel();

        $imagefile = (string) $data['imagefile'];
        $width = (int) $data['width'];
        $height = (int) $data['height'];

        $Image->load($imagefile);
        $Image->resize($width, $height);
        $Image->save("test.jpg");
        $Image->UploadImg("test.jpg");
    }

    public function UploadImg($imagefile, $width, $height, $newfile) : void
    {
        $Image = new ImgResizeModel();

        $Image->load($imagefile);
        //$Image->resize($width, $height);
        $Image->save($newfile);
        $Image->UploadImg($newfile);
    }
}