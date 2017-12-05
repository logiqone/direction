<?php

namespace app\helpers;

use app\models\ImageManager;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class ProductImage
{
    private $product;

    public function __construct($product) {
        $this->product = $product;
    }

    public function Save() {
        if ($this->product->file !== "") {
            $imageManager = ImageManager::findOne($this->product->file);
            $pathParts = pathinfo($imageManager->fileName);

            $fileName = "../web/uploads/imagemanager/".$this->product->file."_".$imageManager->fileHash.".".
                $pathParts['extension'];
            $savePath = "../web/pix/product/b-".mb_strtolower($this->product->code)."-d.jpg";
            $thumbnailPath = "../web/pix/product/s-".mb_strtolower($this->product->code)."-d.jpg";

            $wasPicture = file_exists($savePath);

            if ($wasPicture) rename($savePath, "../web/uploads/imagemanager/".
                $this->product->file."_".$imageManager->fileHash."_temp.".$pathParts['extension']);

            Image::getImagine()->open($fileName)->save($savePath , ['jpeg_quality' => 95]);
            Image::getImagine()->open($savePath)->thumbnail(new Box(152, 133))->save($thumbnailPath,
                    ['jpeg_quality' => 95]);

            if (!$wasPicture) {
                $imageManager->delete();
                unlink($fileName);
            } else {
                rename("../web/uploads/imagemanager/".$this->product->file."_".
                    $imageManager->fileHash."_temp.".$pathParts['extension'], $fileName);
            }
        }
    }
}