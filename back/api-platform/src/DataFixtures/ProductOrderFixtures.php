<?php

namespace App\DataFixtures;

use App\Entity\ProductOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductOrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $category = (new ProductOrder)
                ->setProductId($faker->randomNumber(1, 100))
                ->setQuantity($faker->randomNumber(1, 10));
        }

        $manager->persist($category);
        $manager->flush();
    }

}
