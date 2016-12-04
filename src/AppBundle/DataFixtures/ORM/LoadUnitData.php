<?php

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Unit;


class LoadUnitData extends AbstractFixture implements OrderedFixtureInterface
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

    public function getOrder()
    {
        return 3;
    }
}