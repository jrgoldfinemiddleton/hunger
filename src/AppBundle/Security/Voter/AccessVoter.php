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
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // this Voter handles the food lists
        if (!$subject instanceof UserList && !$subject instanceof FoodBankList) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // user must be logged in, or no access
            return false;
        }

        if ($subject instanceof UserList) {
            if ($user->getFoodBank() !== null) {
                return false;
            }

            if ($subject->getUser() !== $user) {
                return false;
            }
        } elseif ($subject instanceof FoodBankList) {
            if ($user->getFoodBank() === null) {
                return false;
            }

            if ($subject->getUser() !== $user) {
                return false;
            }
        }

        return true;
    }
}