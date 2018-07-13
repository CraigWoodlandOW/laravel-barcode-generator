<?php

/*
    The below BSD licensing statement is copied from the original works, and applies
    to the logic used to generate the barcodes (everything within the 'create' function)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.
    Copyright 2011-2012 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2011-2012 Game Maker 2k - http://intdb.sourceforge.net/
    Copyright 2011-2012 Kazuki Przyborowski - https://github.com/KazukiPrzyborowski
    $FileInfo: validate.php - Last Update: 02/13/2012 Ver. 2.2.5 RC 1 - Author: cooldude2k $
*/

namespace CraigWoodlandOW\LaravelBarcodeGenerator\Utilities;

use CraigWoodlandOW\LaravelBarcodeGenerator\Utilities\Validators;

class Converters
{
    public static function convert_upce_to_upca($upc)
    {
        if (!isset($upc)||!is_numeric($upc)) {
            return false;
        }

        if (strlen($upc)==7) {
            $upc = $upc . Validators::validate_upce($upc, true);
        }

        if (strlen($upc)>8||strlen($upc)<8) {
            return false;
        }

        if (!preg_match("/^0/", $upc)) {
            return false;
        }

        if (Validators::validate_upce($upc)===false) {
            return false;
        }

        if (preg_match("/0(\d{5})([0-3])(\d{1})/", $upc, $upc_matches)) {
            $upce_test = preg_match("/0(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
            if ($upce_test==false) {
                return false;
            }

            if ($upc_matches[6]==0) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7];
            }

            if ($upc_matches[6]==1) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7];
            }

            if ($upc_matches[6]==2) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[6]."0000".$upc_matches[3].$upc_matches[4].$upc_matches[5].$upc_matches[7];
            }

            if ($upc_matches[6]==3) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3]."00000".$upc_matches[4].$upc_matches[5].$upc_matches[7];
            }
        }

        if (preg_match("/0(\d{5})([4-9])(\d{1})/", $upc, $upc_matches)) {
            preg_match("/0(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);

            if ($upc_matches[6]==4) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4]."00000".$upc_matches[5].$upc_matches[7];
            }

            if ($upc_matches[6]==5) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7];
            }

            if ($upc_matches[6]==6) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7];
            }

            if ($upc_matches[6]==7) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7];
            }

            if ($upc_matches[6]==8) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7];
            }

            if ($upc_matches[6]==9) {
                $upce = "0".$upc_matches[1].$upc_matches[2].$upc_matches[3].$upc_matches[4].$upc_matches[5]."0000".$upc_matches[6].$upc_matches[7];
            }
        }

        return $upce;
    }

    public static function convert_upce_to_ean13($upc)
    {
        return Converters::convert_upca_to_ean13(Converters::convert_upce_to_upca($upc));
    }

    public static function convert_upca_to_ean13($upc)
    {
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
