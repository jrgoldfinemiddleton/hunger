<?php

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FoodItem;


class LoadFoodItemData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $foodList = [
            'test',
            'test2',
            'test3'
        ];

        foreach ($foodList as $item) {
            $stdItem = new FoodItem();
            $stdItem->setName($item);

            $manager->persist($stdItem);
        }

        $manager->flush();
    }
}