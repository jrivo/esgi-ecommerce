<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductOrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $products = $manager->getRepository(Product::class)->findAll();
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $category = (new ProductOrder)
                ->setProduct($faker->randomElement($products))
                ->setQuantity($faker->randomNumber(1, 10));
        }

        $manager->persist($category);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }

}
