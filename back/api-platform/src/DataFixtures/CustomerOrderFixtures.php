<?php

namespace App\DataFixtures;

use App\Entity\CustomerOrder;
use App\Entity\ProductOrder;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerOrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productOrders = $manager->getRepository(ProductOrder::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $customerOrder = (new CustomerOrder)
                ->setDatetime($faker->dateTimeBetween('-1 year', 'now'))
                ->setTotalPrice($faker->randomFloat(2, 0, 1000))
                ->setCustomer($faker->randomElement($users))
                ->setStatus($faker->randomElement(['pending', 'paid', 'shipped', 'delivered', 'canceled']))
                ->setDatetime($faker->dateTimeBetween('-1 year', 'now'));
            for ($y = 0; $y < $faker->randomNumber(1, 3); $y++) {
                $customerOrder->addProductOrder($faker->randomElement($productOrders));
            }

            $manager->persist($customerOrder);
            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            ProductOrderFixtures::class,
        ];
    }
}
