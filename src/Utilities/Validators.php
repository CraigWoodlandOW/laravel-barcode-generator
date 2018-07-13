<?php

namespace CraigWoodlandOW\LaravelBarcodeGenerator\Utilities;

class Validators
{
    public static function validate_upca($upc, $return_check = false)
    {
        if(!isset($upc) || !is_numeric($upc)) {
            return false;
        }

        if(strlen($upc) > 12) {
            preg_match("/^(\d{12})/", $upc, $fix_matches);
            $upc = $fix_matches[1];
        }

        if(strlen($upc) > 12 || strlen($upc) < 11) {
            return false;
        }

        if(strlen($upc)==11) {
            preg_match("/^(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
        }

        if(strlen($upc)==12) {
            preg_match("/^(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
        }

        $OddSum = ($upc_matches[1] + $upc_matches[3] + $upc_matches[5] + $upc_matches[7] + $upc_matches[9] + $upc_matches[11]) * 3;
        $EvenSum = $upc_matches[2] + $upc_matches[4] + $upc_matches[6] + $upc_matches[8] + $upc_matches[10];
        $AllSum = $OddSum + $EvenSum;
        $CheckSum = $AllSum % 10;

        if($CheckSum>0) {
            $CheckSum = 10 - $CheckSum;
        }

        if($return_check == false && strlen($upc) == 12) {
            if($CheckSum != $upc_matches[12]) {
                return false;
            }

            if($CheckSum == $upc_matches[12]) {
                return true;
            }
        }

        if($return_check == true) {
            return $CheckSum;
        }

        if(strlen($upc) == 11) {
            return $CheckSum;
        }
    }

    public static function validate_ean13($upc, $return_check=false)
    {
        if (!isset($upc)||!is_numeric($upc)) {
            return false;
        }

        if (strlen($upc)>13) {
            preg_match("/^(\d{13})/", $upc, $fix_matches);
            $upc = $fix_matches[1];
        }

        if (strlen($upc)>13||strlen($upc)<12) {
            return false;
        }

        if (strlen($upc)==12) {
            preg_match("/^(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
        }

        if (strlen($upc)==13) {
            preg_match("/^(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})(\d{1})/", $upc, $upc_matches);
        }

        $EvenSum = ($upc_matches[2] + $upc_matches[4] + $upc_matches[6] + $upc_matches[8] + $upc_matches[10] + $upc_matches[12]) * 3;
        $OddSum = $upc_matches[1] + $upc_matches[3] + $upc_matches[5] + $upc_matches[7] + $upc_matches[9] + $upc_matches[11];
        $AllSum = $OddSum + $EvenSum;
        $CheckSum = $AllSum % 10;

        if ($CheckSum>0) {
            $CheckSum = 10 - $CheckSum;
        }

        if ($return_check==false&&strlen($upc)==13) {
            if ($CheckSum!=$upc_matches[13]) {
                return false;
            }

            if ($CheckSum==$upc_matches[13]) {
                return true;
            }
        }

        if ($return_check==true) {
            return $CheckSum;
        }

        if (strlen($upc)==12) {
            return $CheckSum;
        }
    }
}
