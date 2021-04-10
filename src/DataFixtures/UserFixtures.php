<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //initialisation du générateur faker
        $faker = Factory::create('fr_FR');

        // ====== CREATION DE 2 ADMIN ============

        $admin = new User();

        $admin->setEmail("tony.dugue@gmail.com")
            ->setFirstName("Tony")
            ->setLastName("Dugué")
            ->setRoles(["ROLE_ADMIN"])
            ->setAvatar("https://eu.ui-avatars.com/api/?name=Tony+Dugué");

        $password = $this->encoder->encodePassword($admin, "tdugue");
        $admin->setPassword($password);

        $manager->persist($admin);

        $john = new User();
        $john->setEmail("john.doe@gmail.com")
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setRoles(["ROLE_ADMIN"])
            ->setAvatar("https://eu.ui-avatars.com/api/?name=John+Doe");

        $password = $this->encoder->encodePassword($john, "jdoe");
        $john->setPassword($password);

        $manager->persist($john);

        // ===== CREATION DE 10 USERS ALEATOIRES ======

        for ($i = 1; $i <= 10; $i++) {

            // génération des noms et prénoms avec faker
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();
            $username = "password";

            $user = new User();

            $user
                ->setEmail($faker->freeEmail())
                ->setFirstName($firstname)
                ->setLastName($lastname)
                ->setRoles(["ROLE_USER"])
                ->setAvatar("https://eu.ui-avatars.com/api/?name=" . $firstname . "+" . $lastname);

            $password = $this->encoder->encodePassword($user, $username);
            $user->setPassword($password);

            $manager->persist($user);
            $this->addReference("user-" . $i, $user);
        }

        $manager->flush();
    }
}
