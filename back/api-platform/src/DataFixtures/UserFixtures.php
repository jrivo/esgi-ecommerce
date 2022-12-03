<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $pwd = "password";
        $object = (new User())
            ->setEmail('customer@customer.fr')
            ->setRoles(['ROLE_CUSTOMER']);
        $object->setPassword($this->passwordHasher->hashPassword($object, $pwd));
        $manager->persist($object);
        
        $object = (new User())
            ->setEmail('seller@seller.fr')
            ->setRoles(['ROLE_SELLER']);
        $object->setPassword($this->passwordHasher->hashPassword($object, $pwd));
        $manager->persist($object);

        $object = (new User())
            ->setEmail('admin@admin.fr')
            ->setRoles(['ROLE_ADMIN']);
        $object->setPassword($this->passwordHasher->hashPassword($object, $pwd));
        $manager->persist($object);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductCategoryFixtures::class,
        ];
    }
}
