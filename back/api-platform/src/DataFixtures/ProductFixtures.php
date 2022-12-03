<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $categories = $manager->getRepository(ProductCategory::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->setName($faker->colorName);
            $product->setPrice($faker->randomFloat(2, 0, 100));
            $product->setDescription($faker->paragraph);
            $product->setStock($faker->numberBetween(0, 500));
            $product->setSeller($faker->randomElement($users));

            for ($y = 0; $y < $faker->randomNumber(1, 3); $y++) {
                $product->addCategory($faker->randomElement($categories));
            }

            $manager->persist($product);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            ProductCategoryFixtures::class,
        ];
    }
}
