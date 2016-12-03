<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 12/2/16
 * Time: 7:44 PM
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\FoodBankList;
use AppBundle\Entity\User;
use AppBundle\Entity\UserList;
use AppBundle\Util\DataValidator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AccessVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    /**
     * @inheritDoc
     */
    protected function supports($attribute, $subject)
    {
        // make sure the attribute is supported
        if (!DataValidator::isValidUserPermission($attribute))
            return false;

        // this Voter handles the food lists
        if (!DataValidator::isListType($subject))
            return false;

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // user must be logged in, or no access
        if (!$user instanceof User) {
            return false;
        }


        if ($subject instanceof UserList) {
            return (DataValidator::validateUserAndUserListMatch($user, $subject));
        } else {
            return (DataValidator::validateFoodBankUserAndListMatch($user, $subject));
        }
    }
}