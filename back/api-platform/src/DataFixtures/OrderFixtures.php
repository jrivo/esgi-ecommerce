<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i=0; $i<100; $i++) {
            $object = (new Order())
                ->setDatetime($faker->dateTimeBetween('-1 years'))
                ->setTotal($faker->numberBetween(15, 200))
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }
}
