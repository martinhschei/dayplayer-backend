<?php

namespace Dayplayer\BackendModels\Helpers;

class HelperFunctions
{
    public static function toCents($dollarValue)
    {
        if (is_null($dollarValue) || !is_numeric($dollarValue)) {
            return 0;
        }
        
        return round($dollarValue * 100);
    }

    public static function toDollars($centsValue)
    {
        if (is_null($centsValue) || !is_numeric($centsValue)) {
            return 0;
        }

        return $centsValue / 100;
    }
}
