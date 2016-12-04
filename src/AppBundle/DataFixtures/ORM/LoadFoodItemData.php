<?php

// src/AppBundle/DataFixtures/ORM/LoadFoodItemData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FoodItem;


class LoadFoodItemData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $foodList = [
            '100% Juice Drinks',
            'Apple Sauce',
            'Apples',
            'Beans, Canned',
            'Beans, Dry',
            'Broth',
            'Canola Oil',
            'Chicken, Canned',
            'Chili, Canned',
            'Chocolate',
            'Crackers',
            'Egg Noodles',
            'Flour',
            'Fruit, Canned (in Juice)',
            'Fruit, Dried',
            'Granola Bars',
            'Grits',
            'Honey',
            'Instant Potatoes',
            'Jell-O',
            'Jelly',
            'Jerky',
            'Ketchup',
            'Macaroni & Cheese, Boxed',
            'Mayonnaise',
            'Milk, Non-Dairy',
            'Milk, Shelf-Stable',
            'Mustard',
            'Nuts, Salted',
            'Nuts, Unsalted',
            'Oatmeal',
            'Olive Oil',
            'Other Meat, Canned',
            'Other Nut Butter',
            'Other, Canned',
            'Other, Healthy Snacks',
            'Pancake Mix',
            'Pasta Sauce, Canned',
            'Peanut Butter',
            'Pepper',
            'Popcorn Kernels',
            'Potatoes',
            'Pudding',
            'Quinoa',
            'Rice',
            'Rolled Oats',
            'Salmon, Canned',
            'Salt',
            'Seeds, Unsalted',
            'Sliced Bread',
            'Soup, Canned',
            'Spices',
            'Stew, Canned',
            'Stock',
            'Tortillas',
            'Tuna, Canned',
            'Vegetables, Canned',
            'Whole Grain Cereal',
            'Whole Grain Pasta',
        ];

        foreach ($foodList as $item) {
            $stdItem = new FoodItem();
            $stdItem->setName($item);

            $manager->persist($stdItem);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}