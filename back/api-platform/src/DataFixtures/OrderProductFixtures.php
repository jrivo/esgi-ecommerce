<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $orders = $manager->getRepository(Order::class)->findAll();
        $products = $manager->getRepository(Product::class)->findAll();

        for ($i=0; $i<100; $i++) {
            $object = (new OrderProduct())
                ->setQuantity($faker->numberBetween(1,5))
                ->setOrdered($faker->randomElement($orders))
                ->setProduct($faker->randomElement($products))
            ;

            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrderFixtures::class,
            ProductFixtures::class
        ];
    }
}
