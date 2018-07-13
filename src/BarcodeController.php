<?php

namespace CraigWoodlandOW\LaravelBarcodeGenerator;

use Illuminate\Routing\Controller;
use CraigWoodlandOW\LaravelBarcodeGenerator\Barcodes\itf14;
use CraigWoodlandOW\LaravelBarcodeGenerator\Barcodes\ean13;

class BarcodeController extends Controller
{
    public function show($type, $value)
    {
        header("Content-Type: image/png");

        if($type == 'itf14') {
            $barcode = new itf14;
            $generated = $barcode->create($value);

            if(!$generated) {
                $this->error('Barcode Not Generated');
            }
        } elseif($type == 'ean13') {
            $barcode = new ean13;
            $generated = $barcode->create($value);

            if(!$generated) {
                $this->error('Barcode Not Generated');
            }
        } else {
            $this->error('Invalid Barcode Type');
        }

        exit();
    }

    public function error($string)
    {
        $img = imagecreate(200, 100);

        $white = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $white);

        $black = imagecolorallocate($img, 0, 0, 0);
        imagestring($img, 2, 10, 40, $string, $black);

        header('Content-type: image/png');
        imagepng($img);
        imagedestroy($img);
    }
}
