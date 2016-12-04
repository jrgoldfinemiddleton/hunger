<?php

// src/AppBundle/DataFixtures/ORM/LoadFoodBankData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FoodBank;


class LoadFoodBankData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $foodBanks = [
            [
                'name'          => 'San Francisco Food Bank',
                'address1'      => '900 Pennsylvania Avenue',
                'address2'      => null,
                'city'          => 'San Francisco',
                'state'         => 'CA',
                'zip_code'      => '94107',
                'phone_number'  => '(415) 282-1900',
            ],
            [
                'name'          => 'Semoran Food Pantry',
                'address1'      => '1771 N. Semoran Boulevard',
                'address2'      => null,
                'city'          => 'Orlando',
                'state'         => 'FL',
                'zip_code'      => '32807',
                'phone_number'  => '(407) 658-1818',
            ],
            [
                'name'          => 'Greater Chicago Food Depository',
                'address1'      => '4100 W. Ann Lurie Place',
                'address2'      => null,
                'city'          => 'Chicago',
                'state'         => 'IL',
                'zip_code'      => '60632',
                'phone_number'  => '(773) 247-3663',
            ],
            [
                'name'          => 'San Diego Food Bank',
                'address1'      => '9850 Distribution Avenue',
                'address2'      => null,
                'city'          => 'San Diego',
                'state'         => 'CA',
                'zip_code'      => '92121',
                'phone_number'  => '(858) 527-1419',
            ],
            [
                'name'          => 'Banco de Alimentos de Puerto Rico',
                'address1'      => 'Calle Marginal #9 Corujo Industrial Park',
                'address2'      => 'P.O. Box 2989',
                'city'          => 'Bayamon',
                'state'         => 'PR',
                'zip_code'      => '00960',
                'phone_number'  => '(787) 740-3663',
            ],
            [
                'name'          => 'Kauai Food Bank',
                'address1'      => '3285 Waapa Road',
                'address2'      => null,
                'city'          => 'Lihue',
                'state'         => 'HI',
                'zip_code'      => '96766',
                'phone_number'  => '(808) 246-4737',
            ],
            [
                'name'          => 'Nome Food Bank',
                'address1'      => '505 West 3rd Avenue',
                'address2'      => 'P.O. Box 98',
                'city'          => 'Nome',
                'state'         => 'AK',
                'zip_code'      => '99762',
                'phone_number'  => '(907) 443-5259',
            ],
            [
                'name'          => 'Community FoodBank of New Jersey, Hillside',
                'address1'      => '31 Evans Terminal',
                'address2'      => null,
                'city'          => 'Hillside',
                'state'         => 'NJ',
                'zip_code'      => '07205',
                'phone_number'  => '(908) 355-3663',
            ],
        ];

        foreach ($foodBanks as $bankData) {
            $bank = new FoodBank();
            $now = new \DateTime();

            $bank->setName($bankData['name']);
            $bank->setAddress1($bankData['address1']);
            $bank->setAddress2($bankData['address2']);
            $bank->setCity($bankData['city']);
            $bank->setState($bankData['state']);
            $bank->setZipCode($bankData['zip_code']);
            $bank->setPhoneNumber($bankData['phone_number']);
            $bank->setCreatedAt($now);
            $bank->setUpdatedAt($now);
            $manager->persist($bank);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}