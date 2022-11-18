<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher){}

    public function load(ObjectManager $manager): void
    {
        $object = (new User())
            ->setEmail('user@user.fr')
            ->setRoles(['ROLE_USER'])
        ;
        $object->setPassword($this->passwordHasher->hashPassword($object, 'test'));
        $manager->persist($object);

        $object = (new User())
            ->setEmail('admin@user.fr')
            ->setRoles(['ROLE_ADMIN'])
        ;
        $object->setPassword($this->passwordHasher->hashPassword($object, 'test'));
        $manager->persist($object);

        $object = (new User())
            ->setEmail('seller@user.fr')
            ->setRoles(['ROLE_SELLER'])
        ;
        $object->setPassword($this->passwordHasher->hashPassword($object, 'test'));
        $manager->persist($object);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class
        ];
    }
}
