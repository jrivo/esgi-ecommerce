<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i=0; $i<100; $i++) {
            $object = (new Product())
                ->setName($faker->colorName)
                ->setDescription($faker->paragraph)
                ->setPrice($faker->numberBetween(2, 99))
                ->setNutriScore($faker->randomElement(['A', 'B', 'C', 'D', 'E']))
                ->setStock($faker->numberBetween(0, 500))
            ;

            for ($y=0; $y<$faker->randomNumber(1,3); $y++) {
                $object->addCategory($faker->randomElement($categories));
            }

            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class
        ];
    }
}
