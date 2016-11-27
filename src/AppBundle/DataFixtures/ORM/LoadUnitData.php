<?php

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Unit;


class LoadUnitData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $unitList = [
            'Individual Portion',
            'Small Can',
            'Medium Can',
            'Large Can',
            '1 oz Portion',
            '1 lb Portion',
            'Small Bottle',
            'Medium Bottle',
            'Large Bottle',
            'Small Box',
            'Medium Box',
            'Large Box',
            'Small Bag',
            'Medium Bag',
            'Large Bag',
            'Individual (for Fruits)',
        ];

        foreach ($unitList as $unit) {
            $stdUnit = new Unit();
            $stdUnit->setName($unit);

            $manager->persist($stdUnit);
        }

        $manager->flush();
    }
}