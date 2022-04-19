<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /*private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }*/

    public function upload(UploadedFile $file,$path)
    {
        // generate a random name for the file but keep the extension
        $filename = uniqid().".".$file->getClientOriginalExtension();
        $file->move($path,$filename); // move the file to a path
        $this->resizeImage($path,$filename);

        return $filename;
    }

    /*public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }*/

    public function resizeImage($path, $image_name)
    {
        $thumbWidth = "350";
        $thumbHeight = "350";

        $sourcePath = /*$this->targetDirectory . '/public/' .*/ $path . '/' . $image_name;
        $targetPath = /*$this->targetDirectory . '/public/' .*/ $path . '/' . $image_name;

        $sourcePathinfo = getimagesize($sourcePath);

        $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));

        if($ext == 'jpeg' || $ext == "jpg"){
            $originalImageJpg = imagecreatefromjpeg($sourcePath);
        } else {
            $originalImagePng = imagecreatefrompng($sourcePath);
        }

        $width = $sourcePathinfo[0];
        $height = $sourcePathinfo[1];

        if($width > $height)
        {
            if($width > $thumbWidth){
                $thumbHeight    =   $height*($thumbHeight/$width);
            }

        }

        else if($width < $height)
        {
            if($height > $thumbHeight){
                $thumbWidth    =   $width*($thumbWidth/$height);
            }
        } else {
            $thumbWidth = $width;
            $thumbHeight = $height;
        }

        // Create image with black background
        $thumbImage = imageCreateTrueColor($thumbWidth,$thumbHeight);

        // Add white background
        $whiteBackground = imagecolorallocate($thumbImage, 255, 255, 255);
        imagefill($thumbImage,0,0,$whiteBackground); // fill the background with white

        if($ext == 'jpeg' || $ext == "jpg"){
            imagecopyresampled($thumbImage,$originalImageJpg,0,0,0,0,$thumbWidth,$thumbHeight,$width,$height);
            $result = imagejpeg($thumbImage,$targetPath,80);
        } else {
            imagecopyresampled($thumbImage,$originalImagePng,0,0,0,0,$thumbWidth,$thumbHeight,$width,$height);
            $result = imagepng($thumbImage,$targetPath,9);
        }


        return $result;
    }
}
