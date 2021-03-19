<?php

namespace App\DataFixtures;

use App\Entity\Information;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InformationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Initialisation du générateur Faker
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 15; $i++) {

            // génération des noms et prénoms avec faker
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();
            $username = $firstname . ' ' . $lastname;

            $info = new Information();
            $info
                ->setName($username)
                ->setEmail($firstname . "." . $lastname . "@gmail.com")
                ->setPhone($faker->phoneNumber)
                ->setDescription($faker->sentence(10, true));

            $info->setRoadbook($this->getReference('book-' . mt_rand(1, 15)));

            $manager->persist($info);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RoadbookFixtures::class
        ];
    }
}
