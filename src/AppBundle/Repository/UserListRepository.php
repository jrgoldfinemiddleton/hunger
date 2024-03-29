<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

/**
 * UserListRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserListRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByUser(User $user)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT li FROM AppBundle:UserList li WHERE li.user = :user'
            )->setParameter('user', $user)
            ->getResult();
    }
}
