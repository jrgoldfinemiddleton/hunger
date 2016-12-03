<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 12/3/16
 * Time: 3:14 AM
 */

namespace AppBundle\Util;


class DataValidator
{
    /**
     * @param string $abbr
     * @return bool
     */
    public static function isValidStateAbbr($abbr)
    {
        if (in_array($abbr, [
                "AK", "AL", "AR", "AS", "AZ", "CA", "CO", "CT", "DC", "DE", "FL", "FM", "GA", "GU", "HI",
                "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MH", "MI", "MN", "MO", "MP",
                "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR", "PA", "PR",
                "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VI", "VT", "WA", "WI", "WV", "WY"]
        )) {
            return true;
        }

        return false;
    }

    /**
     * Strips non-numeric formatting or other invalid characters from a possible phone number.
     * @param string $str
     * @return mixed
     */
    public static function normalizePhone($str)
    {
        return preg_replace('/[^0-9]/', '', $str);
    }

    /**
     * Tests a normalized phone number string for the correct number of digits.
     * @param string $phn
     * @return bool
     */
    public static function isValidPhoneNumber($phn)
    {
        return (strlen($phn)) === 10;
    }


    /**
     * Removes all tab and newline characters from a string.
     * @param string $str
     * @return mixed
     */
    public static function stripTabsAndNewLines($str)
    {
        return preg_replace('/[\t\r\n\f\v]/', '', $str);
    }

    /**
     * Tests a normalized zip code string for the correct number of digits.
     * @param string $zip
     * @return bool
     */
    public static function isValidZip($zip)
    {
        return strlen($zip) === 5 && (strlen(preg_replace('/[0-9]/', '', $zip))) === 0;
    }
}