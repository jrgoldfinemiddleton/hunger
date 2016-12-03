<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 12/3/16
 * Time: 3:14 AM
 */

namespace AppBundle\Util;



use AppBundle\Entity\FoodBankList;
use AppBundle\Entity\User;
use AppBundle\Entity\UserList;
use AppBundle\Security\Voter\AccessVoter;

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


    /**
     * Returns true if $attribute is a valid permission type, false otherwise.
     * @param string $attribute
     * @return bool
     */
    public static function isValidUserPermission($attribute)
    {
        // make sure the attribute is supported
        return (in_array($attribute, array(AccessVoter::VIEW, AccessVoter::EDIT)));
    }


    /**
     * @param $object
     * @return bool
     */
    public static function isListType($object)
    {
        return ($object instanceof UserList || $object instanceof FoodBankList);
    }

    /**
     * @param User $user
     * @param UserList $list
     * @return bool
     */
    public static function validateUserAndUserListMatch($user, $list)
    {
        if ($user->getFoodBank() !== null) {
            return false;
        }

        if ($list->getUser() !== $user) {
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     * @param FoodBankList $list
     * @return bool
     */
    public static function validateFoodBankUserAndListMatch($user, $list)
    {
        if ($user->getFoodBank() === null) {
            return false;
        }

        if ($list->getFoodBank() !== $user->getFoodBank()) {
            return false;
        }

        return true;
    }
}