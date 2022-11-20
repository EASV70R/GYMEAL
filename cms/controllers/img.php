<?php

require_once __DIR__.'/../models/imgresize.php';

class Image
{
    public function UploadImg($data) : void
    {
        $Image = new ImgResizeModel();

        $imagefile = (string) $data['imagefile'];
        $width = (string) $data['width'];
        $height = (string) $data['height'];

        $Image->load($imagefile);
        $Image->resize($width, $height);
        $Image->save("test.jpg");
        $Image->UploadImg("test.jpg");
    }
}