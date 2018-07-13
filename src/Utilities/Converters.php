<?php

namespace CraigWoodlandOW\LaravelBarcodeGenerator\Utilities;

use CraigWoodlandOW\LaravelBarcodeGenerator\Utilities\Validators;

class Converters
{
    public static function convert_upca_to_ean13($upc) {
        if(!isset($upc) || !is_numeric($upc)) {
            return false;
        }

        if(strlen($upc) == 11) {
            $upc = $upc . Validators::validate_upca($upc, true);
        }

        if(strlen($upc)>13 || strlen($upc) < 12) {
            return false;
        }

        if(Validators::validate_upca($upc) === false) {
            return false;
        }

        if(strlen($upc) == 12) {
            $ean13 = "0" . $upc;
        }

        if(strlen($upc) == 13) {
            $ean13 = $upc;
        }

        return $ean13;
    }
}
