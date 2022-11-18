<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i<20; $i++) {
            $object = (new Category())
                ->setName($faker->colorName)
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }
}
